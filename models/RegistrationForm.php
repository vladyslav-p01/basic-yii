<?php

namespace app\models;

use Yii;
use yii\base\Model;
//use app\models\Users;

/**
 * LoginForm is the model behind the login form.
 */
class RegistrationForm extends Model
{
    public $username;
    public $password;
    public $passwordConfirm;


    public static function tableName()
    {
        return 'users';
    }

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password', 'passwordConfirm'], 'required'],
            ['username', 'unique', 'targetClass' => 'app\models\User'],
           // password is validated by validatePassword()
            ['password', 'validatePasswordConfirm'],
        ];
    }



    public function validatePasswordConfirm()
    {
        if ($this->password !== $this->passwordConfirm) {
            $this->addError('passwordConfirm', 'password confirmation does not matches with password');
        }
    }

    /**
     * saves new user to db if model passed validation
     * @return bool
     */
    public function register()
    {
        if ($this->validate()) {
            $user = new User();

            $user->username = $this->username;
            //$user->password_hash = Yii::$app->security
                //->generatePasswordHash($this->password);
            $user->password_hash = password_hash($this->password, 1);
            $user->auth_key = Yii::$app->security->generateRandomString();

            if ($user->save()) {
                return true;
            }
            else echo 'Unsaved';
        }

        return false;
    }
}
