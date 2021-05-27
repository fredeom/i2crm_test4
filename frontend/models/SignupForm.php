<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;

class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $repassword;

    public function rules()
    {
        return [
            [['username', 'email'], 'trim'],
            [['username', 'password', 'repassword'], 'required'],
            [['username', 'email'], 'string', 'min' => 2, 'max' => 255],

            ['username', 'unique', 'targetClass' => '\common\models\User', 'targetAttribute' => 'username', 'message' => 'This username has already been taken.'],

            ['email', 'email'],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'string', 'min' => 6],
            ['repassword', 'compare', 'compareAttribute' => 'password']
        ];
    }

    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->status = USER::STATUS_ACTIVE;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        return $user->save();

    }
}
