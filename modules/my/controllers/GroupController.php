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
    
    protected function getGroup($id)
    {
      return Group::findOne(['event_id' => $this->event->id, 'id' => $id]);
    }
    
    public function actionUpdate($id)
    {
      
      $group = $this->getGroup($id);
      
      if ($group->load($_POST)) {

        if ($group->update() !== false) {
          
          Yii::$app->session->addFlash('success', 'Die Gruppe wurde aktualisiert.');
          
          return $this->redirect(['guest/index']);
          
        } else {
          
          Yii::$app->session->addFlash('danger', 'Die Gruppe konnte nicht aktualisiert werden.');

        }

      } 
      
      return $this->render('update', [
        'group' => $group
      ]);
      
    } 
    
    public function actionDelete($id)
    {
      
      $this->getGroup($id)->delete();
      
      Yii::$app->session->addFlash('success', 'Die Gruppe wurde gelöscht.');
      
      return $this->redirect(['guest/index']);
      
    }
    
  }