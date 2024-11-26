
(function ($) {
    "use strict";

    /**
     * Service allowed to change client password by ajax request
     * @param employeeId
     * @constructor
     */
    var PasswordChanger = function (employeeId) {
        this.employeeId = employeeId;
        this.updateUrl = "/profile/api/update-user-password";
        this.active = false;
        this.currentPassword = '';
        this.newPassword = '';
        this.newPasswordAgain = '';
        this.message = null;
    };

    /**
     * Turn the changer on
     */
    PasswordChanger.prototype.activate = function () {
        this.active = true;
        this.setMessage('Заполните поля ниже', 'success');
    };

    /**
     * Set changer message
     * @param text Message text
     * @param type Message type. Will be used as CSS class for the message HTML element
     */
    PasswordChanger.prototype.setMessage = function (text, type) {
        this.message = {text: text, type: type};
    };

    /**
     * Reset changer message
     */
    PasswordChanger.prototype.resetMessage = function () {
        this.message = null;
    };

    /**
     * Pre-validate values and fire POST request
     * @return {boolean}
     */
    PasswordChanger.prototype.requestUpdate = function () {
        var that = this;

        if (!this.currentPassword.length) {
            this.setMessage('Введите текущий пароль', 'warning');
            return false;
        }
        if (this.newPassword.length < 6) {
            this.setMessage('Новый пароль должен содержать не менее 6 символов', 'warning');
            return false;
        }
        if (this.newPassword !== this.newPasswordAgain) {
            this.setMessage('Пароли не совпадают', 'warning');
            return false;
        }

        // POST request params
        var params = {
            employeeId: this.employeeId,
            currentPassword: this.currentPassword,
            newPassword: this.newPassword,
            newPasswordAgain: this.newPasswordAgain
        };

        $.post(this.updateUrl, params, function (response) {
            if (response) {
                if (response.status) {
                    that.setMessage('Пароль успешно изменен', 'success');
                    setTimeout(function () {
                        that.deactivate();
                    }, 2000);
                } else {
                    that.setMessage(response.msg, 'warning');
                }
            }
        });
    };

    // Cleanup changer fields and messages and set to inactive state
    PasswordChanger.prototype.deactivate = function () {
        this.active = false;
        this.currentPassword = '';
        this.newPassword = '';
        this.newPasswordAgain = '';
        this.resetMessage();
    };


    // ~~~ Contact manager ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~//

    /**
     * Profile contact object
     * @param conf
     * @constructor
     */
    var Contact = function (conf) {
        if (typeof conf !== "object") {
            conf = {};
        }
        this.id = conf.id || null;

        this.type = conf.type || 0;
        this.value = conf.value || '';
        this.note = conf.note || '';

        // If contact config has an ID we assume contact is saved already
        this.saved = this.id || false;
        this.errorMessage = '';
    };

    /**
     * Manager for handling profile contacts
     * @param employeeId
     * @constructor
     */
    var ContactManager = function (employeeId) {
        this.employeeId = employeeId;
        this.url = {
            loadContacts: '/profile/api/load-contacts',
            saveContact: '/profile/api/save-contact',
            deleteContact: '/profile/api/delete-contact'
        };
        this.active = false;
        this.contacts = [];

        // List of available contact types with validators
        this.availableTypes = [
            {
                id: 0,
                title: 'Телефон',
                validators: [
                    {re: /^7/, msg: 'Телефон должен начинаться с цифры "7"'},
                    {re: /^[\d]+$/, msg: 'Телефон может содержать только цифры'},
                    {re: /[\d]{10,}/g, msg: 'Телефон должен содержать не менее 10 цифр'},
                    {re: /^[\d]{1,11}$/, msg: 'Телефон не должен содержать более 11 цифр'}
                ]
            },
            {
                id: 1,
                title: 'E-mail',
                validators: [
                    {re: /^[-._a-z0-9]+@(?:[a-z0-9][-a-z0-9]+\.)+[a-z]{2,6}$/, msg: 'Неверный формат e-mail'}
                ]
            },
            {
                id: 2,
                title: 'Факс'
            }
        ];
    };

    /**
     * Load existing contacts by ajax request
     */
    ContactManager.prototype.loadContacts = function () {
        var that = this;

        $.get(this.url.loadContacts, {employeeId: this.employeeId}, function (response) {
            if (response && response.status) {
                if (response.contacts && response.contacts.length) {
                    that.contacts = [];
                    response.contacts.forEach(function (item) {
                        var contact = that.createContact(item);
                        that.contacts.push(contact);
                        if (!that.validateContact(contact)) {
                            contact.saved = false;
                        }
                    });
                }
                that.active = true;
            }
        });
    };

    /**
     * Create and return contact object based on given config data
     * @param conf
     * @return {Contact}
     */
    ContactManager.prototype.createContact = function (conf) {
        return new Contact(conf);
    };

    /**
     * Add new contact to the contacts stack
     */
    ContactManager.prototype.addContact = function () {
        var contact = this.createContact();
        this.validateContact(contact);
        this.contacts.push(contact);
    };

    ContactManager.prototype.saveContact = function (contact) {
        if (!this.validateContact(contact)) {
            return false;
        }

        // POST request params
        var params = {
            employeeId: this.employeeId,
            contactId: contact.id,
            contactType: contact.type,
            contactValue: contact.value,
            contactNote: contact.note
        };

        $.post(this.url.saveContact, params, function (response) {
            if (response.status && response.contactId) {
                contact.id = response.contactId;
                contact.saved = true;
            }
        });
    };

    /**
     * Delete contact by given index
     * @param index
     * @return {boolean}
     */
    ContactManager.prototype.deleteContact = function (index) {
        var that = this,
            contact = this.contacts[index];

        // Contact not saved yet to the server so we just remote it from client
        if (!contact.id) {
            this.contacts.splice(index, 1);
            return true;
        }

        // Confirm action
        // TODO: Use noty?
        if (!confirm('Вы действительно хотите удалить этот контакт?')) {
            return false;
        }

        // Perform delete request to the database
        // TODO: Noty client notification?
        $.post(this.url.deleteContact, {id: contact.id, employeeId: this.employeeId}, function (response) {
            if (response.status) {
                that.contacts.splice(index, 1);
            }
        });
        return true;
    };

    /**
     * Additional actions when contact being changed
     * @param contact
     */
    ContactManager.prototype.onContactChanged = function (contact) {
        this.validateContact(contact);
        contact.saved = false;
    };

    /**
     * Validate given contact
     * @param contact
     * @return {boolean}
     */
    ContactManager.prototype.validateContact = function (contact) {
        contact.errorMessage = '';

        if (!contact.value) {
            contact.errorMessage = 'Введите значение';
            return false;
        }

        var vv = this.getContactTypeValidators(contact.type);
        if (vv && vv.length) {
            for (var i = 0, len = vv.length; i < len; i++) {
                var validator = vv[i];
                if (!contact.value.match(validator.re)) {
                    contact.errorMessage = validator.msg;
                    return false;
                }
            }
        }
        return true;
    };

    /**
     * Returns a list of validators for given type of contact
     * @param typeId
     * @return {array}
     */
    ContactManager.prototype.getContactTypeValidators = function (typeId) {
        var types = this.availableTypes;
        for (var i = 0, len = types.length; i < len; i++) {
            var tObj = types[i];
            if (tObj.id === +typeId) {
                var validators = tObj.validators;
                if (validators && validators.length) {
                    return validators;
                }
            }
        }

        return [];
    };

    // Profile editor
    var profileEditor = new Vue({
        el: '[data-employee-profile-edit]',
        data: {
            employeeId: null,
            passwordChanger: null,
            contactManager: null
        },
        methods: {
            init: function () {
                this.passwordChanger = new PasswordChanger(this.employeeId);
                this.contactManager = new ContactManager(this.employeeId);
                this.contactManager.loadContacts();
            }
        }
    });

    // DOM Loaded
    $(function () {
        // Get edited user ID from root element's data attribute
        profileEditor.employeeId = $('[data-employee-profile-edit]').data('employee-profile-edit');
        profileEditor.init();

        $(document).on("click", "[data-show-image-upload-field]", function (e) {
            e.preventDefault();
            $(this).fadeOut(300, function () {
                $("[data-avatar-image]").fadeTo(200, .5);
                $("[data-image-upload-field]").fadeIn();
            });
            return false;
        });

        // Show images preview
        $(document).on("change", '[data-image-upload-field] input[type=file]', function () {
            var $image = $("[data-avatar-image]");

            if (!$image.length || !this.files.length) {
                return false;
            }

            var reader = new FileReader();
            reader.onload = function(e) {
                $image.css({'background-image': 'url(' + e.target.result + ')'});
            };
            reader.readAsDataURL(this.files[0]);
        });
    });
})(jQuery);