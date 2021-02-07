<?php

  namespace app\modules\my\controllers;

  use Yii;
  
  use app\modules\my\components\Controller;
  use app\models\Group;
  use app\models\Person;

  class GuestController extends Controller
  {
    
    public function actionIndex()
    {
      
      if (Yii::$app->request->isAjax) {
        
        Person::updateAll(['group_id' => null]);
        
        foreach ($_POST['group'] as $groupId => $ids) {
          Person::updateAll(['group_id' => $groupId], ['id' => $ids]);
        }
        
        return true;
        
      }
      
      return $this->render('index', [
        'event' => $this->event,
        'person' => new Person,
        'group' => new Group
      ]);
      
    }
    
    public function actionCreate()
    {
      
      $person = new Person;
      $person->event_id = $this->event->id;

      if ($person->load($_POST)) {

        if ($person->save()) {
          
          Yii::$app->session->addFlash('success', 'Der Gast wurde hinzugefügt.');
          
          $person = new Person;
          
        } else {

          Yii::$app->session->addFlash('danger', 'Der Gast konnte nicht hinzugefügt werden.');
          
        }

      }
      
      return $this->redirect(['index']);
      
    }
    
    public function actionDelete($id)
    {
      return (bool) Person::findOne(['event_id' => $this->event->id, 'id' => $id])->delete();
    }
    
  }