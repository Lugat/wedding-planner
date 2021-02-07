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
          
          Yii::$app->session->addFlash('success', 'Du hast deine Hochzeit aktualisiert.');
          
        } else {
          
          Yii::$app->session->addFlash('danger', 'Deine Hochzeit konnte nicht aktualisiert werden.');
          
        }
        
      }
      
      return $this->render('index', [
        'event' => $this->event
      ]);
      
    }
    
  }
