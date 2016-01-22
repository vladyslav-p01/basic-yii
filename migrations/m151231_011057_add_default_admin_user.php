<?php

use yii\db\Schema;
use yii\db\Migration;

class m151231_011057_add_default_admin_user extends Migration
{
    public function up()
    {
       $this->insert('users', [
           'id_user' => 1,
           'username'=> 'admin',
           'password_hash' => Yii::$app->security->generatePasswordHash('admin'),
           'auth_key' => Yii::$app->security->generateRandomString(),
       ]);

        $this->insert('users', [
            'id_user' => 2,
            'username'=> 'author',
            'password_hash' => Yii::$app->security->generatePasswordHash('author'),
            'auth_key' => Yii::$app->security->generateRandomString(),
        ]);
    }

    public function down()
    {
        $this->delete('users', ['id_user' => 1]);
        $this->delete('users', ['id_user' => 2]);
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
