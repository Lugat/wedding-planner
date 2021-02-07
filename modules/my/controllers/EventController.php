<?php

  namespace app\modules\my\controllers;

  use Yii;
  
  use app\modules\my\components\Controller;

  class EventController extends Controller
  {
    
    public function actionIndex()
    {
      
      if ($this->event->load($_POST)) {
        
        if ($this->event->update() !== false) {
          
          
        } else {
          
        }
        
      }
      
      return $this->render('index', [
        'event' => $this->event
      ]);
      
    }
    
  }
