<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

class ContactForm extends Model
{
    public $name;
    public $email;
    public $subject;
    public $body;
    public $verifyCode;

    public function rules()
    {
        return [
            [['name', 'email', 'subject', 'body'], 'required'],
            ['email', 'email'],
            ['verifyCode', 'captcha', 'captchaAction' => \yii\helpers\Url::to(['main/captcha'])]
        ];
    }

    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verification Code',
        ];
    }

    public function scenarios() {
      $scenarios = parent::scenarios();
      $scenarios['short'] = ['name', 'email'];
      $scenarios['full'] = ['name', 'email', 'subject', 'body', 'verifyCode'];
      return $scenarios;
    }
}
