<?php

  namespace app\controllers;

  use Yii;
  use yii\web\Controller;

  class SiteController extends Controller
  {

    public function actionIndex()
    {
      
      if (isset($_POST['uid'])) {
        return $this->redirect(['event/index', 'uid' => $_POST['uid'], 'tab' => 'general']);
      }
      
      return $this->render('index');
      
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
