<?php

use \yii\bootstrap\ActiveForm;
use \yii\helpers\Url;
use \yii\helpers\Html;

?>

<!-- Modal -->
<div id="loginpop" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="row">
        <div class="col-sm-6 login">
          <h4>Login</h4>
          <?php $form = ActiveForm::begin([
                  'enableAjaxValidation' => true,
                  'validationUrl' => Url::to(['/validate/index']),
                ]);
          ?>
          <?= $form->field($model, 'username')->textInput(['placeholder' => 'Enter username'])->label(false) ?>
          <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Password'])->label(false) ?>
          <?= $form->field($model, 'rememberMe', ['options' => ['tag' => false]])->checkbox()->label('Remember me') ?>

          <?= Html::submitButton('Sign in', ['class' => 'btn btn-success']) ?>

          <?php ActiveForm::end(); ?>
        </div>
        <div class="col-sm-6">
            <h4>New User Sign Up</h4>
            <p>Join today and get updated with all the properties deal happening around.</p>
            <button type="submit" class="btn btn-info"  onclick="window.location.href='<?= Url::to('/main/main/register/') ?>'">Join Now</button>
        </div>
      </div>
    </div>
  </div>
</div>
  <!-- /.modal -->




  <!--form role="form">
    <div class="form-group">
      <label class="sr-only" for="exampleInputEmail2">Email address</label>
      <input type="email" class="form-control" id="exampleInputEmail2" placeholder="Enter email">
    </div>
    <div class="form-group">
      <label class="sr-only" for="exampleInputPassword2">Password</label>
      <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Password">
    </div>
    <div class="checkbox">
      <label>
        <input type="checkbox"> Remember me
      </label>
    </div>
    <button type="submit" class="btn btn-success">Sign in</button>
  </form>          
</div>
<div class="col-sm-6">
  <h4>New User Sign Up</h4>
  <p>Join today and get updated with all the properties deal happening around.</p>
  <button type="submit" class="btn btn-info"  onclick="window.location.href='register.html'">Join Now</button>
</div-->
