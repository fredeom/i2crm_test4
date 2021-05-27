<?php

namespace common\models;

use Yii;

use \yii\behaviors\TimestampBehavior;
use \yii\db\ActiveRecord;

/**
 * This is the model class for table "message".
 *
 * @property int|null $fk_author
 * @property string|null $message
 * @property boolean $mark
 * @property int $created_at
 * @property int $idmessage
 *
 * @property User $user
 */
class Message extends ActiveRecord
{
    public static function tableName()
    {
        return 'message';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                ],
            ]
        ];
    }

    public function rules()
    {
        return [
            [['fk_author'], 'default', 'value' => null],
            [['fk_author', 'created_at'], 'integer'],
            [['message'], 'string'],
            [['mark'], 'default', 'value' => false],
            //[['created_at'], 'required'],
            [['fk_author'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['fk_author' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'fk_author' => 'FkAuthor',
            'message' => 'Message',
            'mark' => 'Marked As Incorrect',
            'created_at' => 'Created At',
            'idmessage' => 'Idmessage',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'fk_author']);
    }

    public function setMark($isCorrect)
    {
      $this->mark = $isCorrect;
      return $this;
    }
}
