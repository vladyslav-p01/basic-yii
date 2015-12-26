<?php

namespace app\models;

use Yii;
use

/**
 * This is the model class for table "users".
 *
 * @property integer $id_user
 * @property string $login
 * @property string $password_hash
 * @property string $auth_key
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['login', 'password_hash'], 'required'],
            [['login', 'auth_key'], 'string', 'max' => 255],
            [['password_hash'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_user' => 'Id User',
            'login' => 'Login',
            'password_hash' => 'Password Hash',
            'auth_key' => 'Auth Key',
        ];
    }
}
