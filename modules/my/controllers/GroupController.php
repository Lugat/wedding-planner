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
          $group = new Group;
        } else { 

        }

      }
      
      return $this->redirect(['guest/index']);
      
    }
    
    public function actionDelete($id)
    {
      
      Group::findOne(['event_id' => $this->event->id, 'id' => $id])->delete();
      
      return $this->redirect(['guest/index']);
      
    }
    
  }