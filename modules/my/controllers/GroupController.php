<?php

  namespace app\modules\my\controllers;

  use Yii;
  
  use app\modules\my\components\Controller;
  use app\models\Group;

  class GroupController extends Controller
  {
    
    public function actionCreate()
    {
      
      $group = new Group;
      $group->event_id = $this->event->id;

      if ($group->load($_POST)) {

        if ($group->save()) {
          
          Yii::$app->session->addFlash('success', 'Die Gruppe wurde erstellt.');
          
          $group = new Group;
          
        } else { 

          Yii::$app->session->addFlash('danger', 'Die Gruppe konnte nicht erstellt werden.');
          
        }

      }
      
      return $this->redirect(['guest/index']);
      
    }
    
    public function actionDelete($id)
    {
      
      Group::findOne(['event_id' => $this->event->id, 'id' => $id])->delete();
      
      Yii::$app->session->addFlash('success', 'Die Gruppe wurde gelöscht.');
      
      return $this->redirect(['guest/index']);
      
    }
    
  }