<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

?>

<div class="advert-form">
  <?php $form = ActiveForm::begin(); ?>

  <?=$form->field($model,'password')->passwordInput() ?>
  <?=$form->field($model,'repassword')->passwordInput() ?>


  <?= Html::submitButton('Change password', ['class' => 'btn btn-primary']) ?>

  <?php ActiveForm::end() ?>
</div>