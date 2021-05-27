<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use frontend\widgets\MessageContainerWidget;

$css = <<<CSS

.admin_mark {
  background: #bada55;
}

.grayed {
  background: #aaa;
}

.info {
  color: lightgray;
}

CSS;

$this->registerCss($css, ["type" => "text/css"], "mynextstyle" );

?>
<?php Pjax::begin(['enablePushState' => false]); ?>

<?= MessageContainerWidget::widget(['messages' => $messages, 'showOnlyMarked' => true]) ?>

<?php Pjax::end(); ?>
