<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use frontend\widgets\MessageContainerWidget;

$this->title = 'Marked';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php Pjax::begin(['enablePushState' => false]); ?>

<?= MessageContainerWidget::widget([
  'messages' => $messages,
  'showOnlyMarked' => true,
  'isAdmin' => $isAdmin,
  'pagination' => $pagination]) ?>

<?php Pjax::end(); ?>
