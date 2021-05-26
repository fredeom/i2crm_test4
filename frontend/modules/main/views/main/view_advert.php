<?php

use \frontend\widgets\HotWidget;
use \frontend\components\Common;
use yii\helpers\Html;

?>
<div id="asdfasdfjhagsdfkjh" style="display:block"></div>
<div class="row">
  <div class="col-lg-3 col-sm-4 hidden-xs">
    <?= HotWidget::widget() ?>
    <div class="advertisement">
      <h4>Advertisements</h4>
      <img src="images/advertisements.jpg" class="img-responsive" alt="advertisement">
    </div>
  </div>
  <div class="col-lg-9 col-sm-8 ">
    <h2><?= Common::getTitleAdvert($model) ?></h2>
    <div class="row">
      <div class="col-lg-8">
        <div class="property-images">
          <!-- Slider Starts -->
          <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators hidden-xs">
              <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
              <?php foreach (range(1, count($images) - 1) as $s): ?>
                <li data-target="#myCarousel" data-slide-to="<?=$s ?>"></li>
              <?php endforeach; ?>
            </ol>
            <div class="carousel-inner">
              <div class="item active">
                <img src="<?= Common::getImageAdvert($model)[0] ?>"  class="properties" alt="properties" />
              </div>
              <?php foreach($images as $image): ?>
                <div class="item">
                  <img src="<?= $image ?>" class="properties" alt="properties" />
                </div>
              <?php endforeach ?>
            </div>
            <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
          </div>
          <!-- #Slider Ends -->
        </div>
        <div class="spacer">
          <h4>
            <span class="glyphicon glyphicon-th-list"></span>
            Properties Detail
          </h4>
          <p><?= $model->description ?></p>
        </div>
        <div>
          <h4>
            <span class="glyphicon glyphicon-map-marker"></span>
            Location
          </h4>
          <div class="well">
            <iframe width="100%"
                  height="350"
              frameborder="0"
                scrolling="no"
            marginheight="0"
              marginwidth="0"
                      src="../../../maps.google.com/fi000001.002642&t=m&z=14&output=embed">
            </iframe>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="col-lg-12  col-sm-6">
          <div class="property-info">
            <p class="price">$ <?=number_format($model->price) ?></p>
            <p class="area">
              <span class="glyphicon glyphicon-map-marker"></span>
              <?= $model->address ?>
            </p>
            <div class="profile">
              <span class="glyphicon glyphicon-user"></span>
              Agent Details
              <p>
                <?=$model?->user?->email ?><br>
                <?=$model?->user?->username ?>
              </p>
            </div>
          </div>
          <h6>
            <span class="glyphicon glyphicon-home"></span>
            Availabilty
          </h6>
          <div class="listing-detail">
            <?php
              $listingItems = [
                "bedroom" => "Bed Room",
                "livingroom" => "Living Room",
                "parking" => "Parking",
                "kitchen" => "Kitchen"
              ];
            ?>
            <?php foreach ($listingItems as $name => $desc): ?>
              <span data-toggle="tooltip"
                    data-placement="bottom"
                    data-original-title="<?= $desc ?>">
                <?= $model->$name ?>
              </span>
            <?php endforeach ?>
          </div>
        </div>
        <div class="col-lg-12 col-sm-6">
          <div class="enquiry">
            <h6>
              <span class="glyphicon glyphicon-envelope"></span>
              Post Enquiry
            </h6>
            <?php $form = \yii\bootstrap\ActiveForm::begin() ?>
              <?= $form->field($model_feedback, 'email')->textInput(['value' => $current_user['email'], 'placeholder' => 'you@yourdomain.com'])->label(false) ?>
              <?= $form->field($model_feedback, 'name')->textInput(['value' => $current_user['username'], 'placeholder' => 'Username'])->label(false) ?>
              <?= $form->field($model_feedback, 'text')->textarea(['rows' => 6, 'placeholder' => 'Whats on your mind?'])->label(false) ?>
              <?= Html::submitButton('Send Message', ['class' => 'btn btn-primary']) ?>
            <?php \yii\bootstrap\ActiveForm::end(); ?>
          </div> <!-- <div class="enquiry"> -->
        </div> <!-- <div class="col-lg-12 col-sm-6"> -->
      </div> <!-- <div class="col-lg-4"> -->
    </div> <!-- <div class="row"> -->
  </div> <!-- <div class="col-lg-9 col-sm-8 "> -->
</div> <!-- <div class="row"> -->

<script>
  $(document).ready(() => {
    const magicElement = $("#asdfasdfjhagsdfkjh");
    magicElement.parent().addClass('properties-listing');
    magicElement.remove();
  });
</script>