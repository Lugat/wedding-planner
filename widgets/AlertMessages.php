<?php

  namespace app\widgets;
  
  use Yii;
  use yii\base\Widget;
  use yii\helpers\Html;
     
  class AlertMessages extends Widget
  {
    
    public function run()
    {
      
      $html = [];
            
      foreach (Yii::$app->session->allFlashes as $key => $messages) {
        $html[] = Html::tag('div', implode('<br />', $messages), ['class' => "alert alert-{$key}"]);
      }
      
      return implode(PHP_EOL, $html);  
      
    }
    
  }