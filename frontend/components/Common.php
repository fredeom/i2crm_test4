<?php

namespace frontend\components;

use yii\base\Component;
use yii\helpers\BaseFileHelper;
use yii\helpers\Url;

class Common extends Component {

  const EVENT_NOTIFY = 'notify_admin';

  public function sendMail($subject, $body, $email = '', $name='') {
    if (empty($email)) $email = \Yii::$app->user->identity->email;
    if (\Yii::$app->mail->compose()
      ->setFrom(['fredeom@ya.ru', 'Admin'])
      ->setTo([$email => $name])
      ->setSubject($subject)
      ->setTextBody($body)
      //->attach(__DIR__ . '/image.jpg', ['fileName' => 'image.jpg'])
      ->send()) {
        $this->trigger(static::EVENT_NOTIFY);
        return true;
      };
    // $transport = (new \Swift_SmtpTransport('smtp.yandex.ru', 465, 'ssl'))->setUsername('fredeom@yandex.ru')->setPassword('slovaslova');
    // $mailer = new \Swift_Mailer($transport);
    // $message = (new \Swift_Message($subject))->setFrom(['fredeom@ya.ru' => 'sms'])->setTo([$email => $name])->setBody($body);
    // $result = $mailer->send($message);
    return false;
  }

  public function notifyAdmin($event) {
    echo 'Notify Admin';
  }

  public static function getTitleAdvert($data)
  {
    return $data['bedroom'].' Bed Rooms and '.$data['kitchen'].' Kitchen Room Aparment on Sale';
  }

  public static function getImageAdvert($data, $general = true, $original = false)
  {
    $images = [];
    if ($general) {
        $images[] = '/uploads/adverts/'.$data['idadvert'].'/general/small_'.$data['general_image'];
    } else {
      $path = \Yii::getAlias("@frontend/web/uploads/adverts/".$data['idadvert']);
      $files = BaseFileHelper::findFiles($path);
      foreach($files as $file){
        if (strstr($file, "small_") && !strstr($file, "general")) {
            $images[] = '/uploads/adverts/' . $data['idadvert'] . '/' . basename($file);
        }
      }
    }
    return $images;
  }

  // public static function getImageAdvert($data,$general = true,$original = false)
  // {
  //   $image = [];
  //   $base = Url::base();
  //   if ($original) {
  //     $image[] = $base.'/uploads/adverts/'.$data['idadvert'].'/general/'.$data['general_image'];
  //   } else {
  //     $image[] = $base.'/uploads/adverts/'.$data['idadvert'].'/general/small_'.$data['general_image'];
  //   }
  //   return $image;
  // }

  public static function substr($text, $start = 0, $end = 50)
  {
    return mb_substr($text, $start, $end);
  }

  public static function getType($row){
    return $row['sold'] ? 'Sold' : 'New';
  }

  public static function getUrlAdvert($row){
    return Url::to(['/main/main/view-advert', 'id' => $row['idadvert']]);
  }
}