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
        
        Person::updateAll(['event_id' => $this->event->id, 'group_id' => null]);
        
        foreach ($_POST['group'] as $groupId => $ids) {
          Person::updateAll(['group_id' => $groupId], ['event_id' => $this->event->id, 'id' => $ids]);
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
    
    protected function getPerson($id)
    {
      return Person::findOne(['event_id' => $this->event->id, 'id' => $id]);
    }
    
    public function actionUpdate($id)
    {
      
      $person = $this->getPerson($id);
      
      if ($person->load($_POST)) {

        if ($person->update() !== false) {
          
          Yii::$app->session->addFlash('success', 'Der Gast wurde aktualisiert.');
          
          return $this->redirect(['index']);
          
        } else {
          
          Yii::$app->session->addFlash('danger', 'Der Gast konnte nicht aktualisiert werden.');

        }

      } 
      
      return $this->render('update', [
        'person' => $person
      ]);
      
    }
    
    public function actionDelete($id)
    {
      return (bool) $this->getPerson($id)->delete();
    }
    
  }