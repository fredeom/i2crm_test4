<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use frontend\widgets\MessageContainerWidget;

?>
<?php Pjax::begin(['enablePushState' => false]); ?>

<?= MessageContainerWidget::widget(['messages' => $messages, 'showOnlyMarked' => true]) ?>

<?php Pjax::end(); ?>
