<?php

use yii\bootstrap\Nav;

?>

<?= \frontend\widgets\Alert::widget() ?>

<!-- Header Starts -->
<div class="navbar-wrapper">
        <div class="navbar-inverse" role="navigation">
          <div class="container">
            <div class="navbar-header">

              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>

            </div>


            <!-- Nav Starts -->
            <div class="navbar-collapse collapse">
                <?= Nav::widget([
                      'options' => ['class' => 'navbar-nav navbar-right'],
                      'items' => [
                        ['label' => 'Home', 'url' => '/'],
                        ['label' => 'About', 'url' => ['/main/main/page', 'view' => 'about']],
                        ['label' => 'Contact', 'url' => ['/main/main/page', 'view' => 'contact']],
                      ],
                    ]);
                ?>
            </div>
            <!-- #Nav Ends -->

          </div>
        </div>

    </div>
<!-- #Header Starts -->





<div class="container">
  <!-- Header Starts -->
  <div class="header">
      <a href="/" ><img src="/images/logo.png"  alt="Realestate"></a>
      <?= Nav::widget([
            'options' => ['class' => 'pull-right'],
            'items' => \Yii::$app->user->isGuest ? [
              [
                'label' => 'Login',
                'url' => '#',
                'linkOptions' => [
                  'data-target' => '#loginpop',
                  'data-toggle' => "modal"
                ]
              ]
            ] : [
              [
                'label' => 'Manager adverts',
                'url' => ['/cabinet/advert']
              ],
              [
                'label' => 'Settings',
                'url' => ['/cabinet/default/settings']
              ],
              [
                'label' => 'Change Password',
                'url' => ['/cabinet/default/change-password']
              ],
              [
                'label' => 'Logout',
                'url' => ['/site/logout'],
                'linkOptions' => ['data-method' => 'post']
              ]
            ],
          ])
      ?>
  </div>
</div>
