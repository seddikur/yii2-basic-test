<?php

use yii\db\Migration;
use app\models\Users;

/**
 * Данные для таблицы Users
 */
class m241022_070932_seed_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        {
            $faker = \Faker\Factory::create();
            $password = 'admin';
            $dateTime = (new DateTime())->getTimestamp();
                $this->insert(
                    'users',
                    [
                        'username' => 'admin',
                        'auth_key' => Yii::$app->security->generateRandomString(),
                        'password_hash' => Yii::$app->security->generatePasswordHash($password),
                        'password_reset_token' => Yii::$app->security->generateRandomString() . '_' . time(),
                        'email' => $faker->email,
                        'last_name' => $faker->lastName,
                        'first_name' => $faker->firstName,
                        'patronymic' => $faker->name,
                        'verification_token' => Yii::$app->security->generateRandomString() . '_' . time(),
                        'status' => Users::STATUS_ACTIVE,
                        'created_at' => $dateTime,
                        'updated_at' => $dateTime,
//                        'role' => Users::Role_Admin
                    ],

                );
        }

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

    }


}
