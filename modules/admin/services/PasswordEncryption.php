<?php


namespace app\modules\admin\services;

use app\models\Users;
use yii\helpers\VarDumper;

/**
 *
 *
 * Обратимое шифрование на PHPбиблиотекой OpenSSL
 * Функции библиотеки Mcrypt, такие как mcrypt_encrypt и mcrypt_decrypt считаются устаревшими и не рекомендуют их использовать.
 * Начиная с PHP 7.2 библиотеку Mcrypt перенесли в PECL.
 * Вместо MCrypt предлагается использовать openssl_encrypt и openssl_decrypt из библиотеки OpenSSL.
 *
 * мойПарольСуперСложный__88
 * BxeF6lyC+ysxMXFHP4fn/fr2yzvmqQfk2WPcu/z4ryfZjZRGmkzAeqqcnnA80pItx8xEFtS03WqpJlZ8LV+99L60kO7SrnmpbyRjboQb7xiCUqrWzyIofMHUm5zDOQC/
 */
class PasswordEncryption
{

    public $cipher = "AES-128-CBC";

    public $constant_name = 'ENCRYPTION_KEY';
    public $value = 'ab86d144e3f080b61c7c2e43';

    /** @var false|int Получает длину инициализирующего вектора шифра */
    public $ivlen;

    public function __construct()
    {
        $this->ivlen = $this->cipherIvLength();
    }

    /**
     * Дешифрование пароля
     * @param $password
     * @return string
     */
    public function decryptingPassword($password)

    {
        define($this->constant_name, $this->value);

//        // Получает длину инициализирующего вектора шифра
        $ivlen = $this->ivlen;

//        // Генерирует псевдослучайную последовательность байт
        $iv = $this->randomPseudoBytes($ivlen);

        // Шифрует данные
        $ciphertext_raw = openssl_encrypt($password, $this->cipher, ENCRYPTION_KEY, $options = OPENSSL_RAW_DATA, $iv);

        // Генерирует хеш-код на основе ключа через метод HMAC
        $hmac = hash_hmac('sha256', $ciphertext_raw, ENCRYPTION_KEY, $as_binary = true);
        $cipherPassword = base64_encode($iv . $hmac . $ciphertext_raw);

        return $cipherPassword;
    }


    /**
     * Обратное шифрование
     *
     * @return void
     */
    public function reverseEncryption($cipherPassword)
    {

        define($this->constant_name, $this->value);
        $c = base64_decode($cipherPassword);
        //Получает длину инициализирующего вектора шифра
        $ivlen = $this->cipherIvLength();

        //Возвращает подстроку
        $iv = substr($c, 0, $ivlen);

        $hmac = substr($c, $ivlen, $sha2len = 32);

        $ciphertext_raw = substr($c, $ivlen + $sha2len);
        // Расшифровывает данные
        $decryptPassword = openssl_decrypt($ciphertext_raw, $this->cipher, ENCRYPTION_KEY, $options = OPENSSL_RAW_DATA, $iv);
        $calcmac = hash_hmac('sha256', $ciphertext_raw, ENCRYPTION_KEY, $as_binary = true);
//        if (hash_equals($hmac, $calcmac)) {
//            echo 'пароль';
//            echo '<br>';
//            echo $decryptPassword;
//        }
        return $decryptPassword;
    }

    /**
     * Получает длину инициализирующего вектора шифра
     * @return false|int
     */
    protected function cipherIvLength()
    {
        return openssl_cipher_iv_length($this->cipher);
    }

    /**
     * Генерирует псевдослучайную последовательность байт
     * (сохраняется в базе)
     * @return void
     */
    public function randomPseudoBytes()
    {
        return openssl_random_pseudo_bytes($this->ivlen);
    }


}