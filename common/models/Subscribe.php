<?php

namespace common\models;

use Yii;

class Subscribe extends \yii\db\ActiveRecord
{
  public static function tableName()
  {
    return 'subscribe';
  }

  public function rules()
  {
    return [
      [['date_subscribe'], 'safe'],
      ['email', 'required'],
      ['email', 'email'],
      ['email', 'unique'],
    ];
  }

  public function attributeLabels()
  {
    return [
      'idsubscribe' => 'Idsubscribe',
      'email' => 'Email',
      'date_subscribe' => 'Date Subscribe',
    ];
  }
}
