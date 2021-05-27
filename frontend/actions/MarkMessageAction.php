<?php

namespace frontend\actions;

use \common\models\Message;

class MarkMessageAction extends \yii\base\Action
{
    public $backUrl;

    public function run($shouldMark, $idmessage)
    {
        if (\Yii::$app->request->isAjax && !empty($idmessage)) {
            Message::find()->where(['idmessage' => $idmessage])->one()->setMark((bool)$shouldMark)->save();
        }
        return $this->controller->redirect($this->backUrl);
    }
}