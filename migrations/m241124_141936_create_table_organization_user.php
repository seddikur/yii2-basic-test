<?php

use yii\db\Migration;

/**
 * Class m241124_141936_create_table_organization_user
 */
class m241124_141936_create_table_organization_user extends Migration
{
    /**
     * Наименование таблицы, которая создается
     */
    const TABLE_NAME = 'organization_user';
    /**
     * Поля, которые имеют внешние ключи
     */
    const FIELD_USER_ID_NAME = 'user_id';
    const FIELD_ORGANIZATION_ID_NAME = 'organization_id';

    /** @var string наименование внешнего ключа для добавляемого поля user_id */
    private $fkUserIdName;

    /** @var string наименование внешнего ключа для добавляемого поля organization_id */
    private $fkOrganizationIdName;

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->fkUserIdName = 'fk_' . self::TABLE_NAME . '_' . self::FIELD_USER_ID_NAME;
        $this->fkOrganizationIdName = 'fk_' . self::TABLE_NAME . '_' . self::FIELD_ORGANIZATION_ID_NAME;
    }
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB COMMENT "Организации-Пользователь"';
        }
        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            self::FIELD_USER_ID_NAME => $this->integer()->notNull()->comment('ID пользователя'),
            self::FIELD_ORGANIZATION_ID_NAME => $this->integer()->notNull()->comment('ID организации'),
        ], $tableOptions);

        $this->createIndex(self::FIELD_USER_ID_NAME, self::TABLE_NAME, self::FIELD_USER_ID_NAME);
        $this->createIndex(self::FIELD_ORGANIZATION_ID_NAME, self::TABLE_NAME, self::FIELD_ORGANIZATION_ID_NAME);
        $this->addForeignKey($this->fkUserIdName, self::TABLE_NAME, self::FIELD_USER_ID_NAME, \app\models\Users::tableName(), 'id');
        $this->addForeignKey($this->fkOrganizationIdName, self::TABLE_NAME, self::FIELD_ORGANIZATION_ID_NAME, 'organizations', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey($this->fkOrganizationIdName, self::TABLE_NAME);
        $this->dropForeignKey($this->fkUserIdName, self::TABLE_NAME);
        $this->dropIndex(self::FIELD_ORGANIZATION_ID_NAME,self::TABLE_NAME);
        $this->dropIndex(self::FIELD_USER_ID_NAME,self::TABLE_NAME);

        $this->dropTable(self::TABLE_NAME);
    }

}
