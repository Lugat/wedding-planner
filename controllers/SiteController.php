<?php

  namespace app\controllers;

  use Yii;
  use yii\web\Controller;
  
  use app\models\Event;

  class SiteController extends Controller
  {

    public function actionIndex()
    {
      
      if (isset($_POST['uid'])) {
        
        $identity = Event::findIdentity($_POST['uid']);
        
        Yii::$app->user->login($identity);
        
        return $this->redirect(['my/event/index']);
        
      }
      
      return $this->render('index');
      
    }
    
    public function actionCreate()
    {
            
      $event = new Event;
      if ($event->load($_POST)) {
        
        if ($event->save()) {
          
          Yii::$app->session->addFlash('success', 'Du kannst nun loslegen. Bitte merk dir deine ID.');
          
          $identity = Event::findIdentity($event->uid);
        
          Yii::$app->user->login($identity);

          return $this->redirect(['my/event/index']);
         
        } else {
          
          Yii::$app->session->addFlash('danger', 'Etwas ist schief gelaufen.');
          
        }
        
      }
      
      return $this->render('create', [
        'event' => $event
      ]);
      
    }
    
    public function actionLogout()
    {
      
      Yii::$app->user->logout();
      
      return $this->redirect(['index']);
      
    }
    
    public function actionError()
    {
      
      $exception = Yii::$app->errorHandler->exception;
      
      print '<pre>';
      print_r($exception);
      print '</pre>';
      exit();
      
      return $this->render('error', [
        'exception' => $exception
      ]);
      
    }

  }
