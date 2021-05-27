<?php

namespace frontend\widgets;

use yii\bootstrap\Widget;
use \common\models\User;

class MessageContainerWidget extends Widget
{
    public $messages = [];
    public $showOnlyMarked = false;

    public function run()
    {
        $isAdmin = User::findOne(\Yii::$app->user->id)?->isAdmin() ?? false;

        return $this->render('message_container', [
            'messages' => $this->messages,
            'isAdmin' => $isAdmin,
            'showOnlyMarked' => $this->showOnlyMarked
        ]);
    }
}
