<?php

namespace common\models;

use frontend\components\Common;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "advert".
 *
 * @property int $idadvert
 * @property int|null $price
 * @property string|null $address
 * @property int|null $fk_agent
 * @property int|null $bedroom
 * @property int|null $livingroom
 * @property int|null $parking
 * @property int|null $kitchen
 * @property string|null $general_image
 * @property string|null $description
 * @property string|null $location
 * @property int|null $hot
 * @property int|null $sold
 * @property string|null $type
 * @property int|null $recommend
 * @property int $created_at
 * @property int $updated_at
 */
class Advert extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'advert';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    public function scenarios(){
      $scenarios = parent::scenarios();
      $scenarios['step2'] = ['general_image'];

      return $scenarios;
    }

    public function rules()
    {
        return [
            [['price'], 'required'],
            [['price', 'fk_agent', 'bedroom', 'livingroom', 'parking', 'kitchen', 'hot', 'sold', 'type', 'recommend'], 'integer'],
            [['description'], 'string'],
            [['address'], 'string', 'max' => 255],
            [['location'], 'string', 'max' => 50],
        ];
    }

    public function getTitle(){
      return Common::getTitleAdvert($this);
    }

    public function attributeLabels()
    {
        return [
            'idadvert' => 'Idadvert',
            'price' => 'Price',
            'address' => 'Address',
            'fk_agent' => 'Fk Agent Detail',
            'bedroom' => 'Bedroom',
            'livingroom' => 'Livingroom',
            'parking' => 'Parking',
            'kitchen' => 'Kitchen',
            'general_image' => 'General Image',
            'description' => 'Description',
            'location' => 'Location',
            'hot' => 'Hot',
            'sold' => 'Sold',
            'type' => 'Type',
            'recommend' => 'Recommend',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getUser()
    {
      return $this->hasOne(User::className(), ['id' => 'fk_agent']);
    }

    public function getCreatedAtFormatted() { // NO SORTING
      return \Yii::$app->formatter->asDate($this->created_at, 'php:Y-m-d');
    }

    public function afterValidate()
    {
        $this->fk_agent = Yii::$app->user->identity->id;
    }

    public function afterSave($insert, $changedAttributes)
    {
        Yii::$app->cache->set('id', $this->idadvert);
    }
}
