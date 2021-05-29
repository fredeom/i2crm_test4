<?php

namespace frontend\widgets;

use yii\bootstrap\Widget;

class MessageContainerWidget extends Widget
{
    public $messages = [];
    public $showOnlyMarked = false;
    public $pagination;
    public $isAdmin = false;

    public function run()
    {
        return $this->render('message_container', [
            'messages' => $this->messages,
            'isAdmin' => $this->isAdmin,
            'showOnlyMarked' => $this->showOnlyMarked,
            'pagination' => $this->pagination,
        ]);
    }
}
