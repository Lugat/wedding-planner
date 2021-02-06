<?php

  namespace app\controllers;

  use Yii;
  use yii\web\Controller;
  
  use app\models\Event;
  use app\models\Group;
  use app\models\Person;
  use app\models\Table;

  class EventController extends Controller
  {
    
    public $event;

    public function actionCreate()
    {
            
      $event = new Event;
      if ($event->load($_POST)) {
        
        if ($event->save()) {
          
          Yii::$app->session->addFlash('success', 'Du kannst nun loslegen. Bitte merk dir deine ID.');

          return $this->redirect(['event/index', 'uid' => $event->uid, 'tab' => 'general']);
         
        } else {
          
          Yii::$app->session->addFlash('danger', 'Etwas ist schief gelaufen.');
          
        }
        
      }
      
      return $this->render('create', [
        'event' => $event
      ]);
      
    }
    
    public function actionIndex($uid, $tab = 'general')
    {

      $event = Event::findOne(['uid' => $uid]);
      if (isset($event)) {
        
        $this->event = $event;
        
        $fn = 'tab'.ucfirst($tab);
        
        if (method_exists($this, $fn)) {
          return $this->$fn($event);
        } 
        
      }
      
      Yii::$app->session->addFlash('danger', 'Wir konnten deine Hochzeit nicht finden.');
      
      return $this->redirect(['site/index']);
      
    }
    
    protected function tabGeneral($event)
    {
      
      if ($event->load($_POST)) {
        
        if ($event->update() !== false) {
          
          
        } else {
          
        }
        
      }
      
      return $this->render('index', [
        'event' => $event,
      ]);
      
    }
    
    protected function tabGuests($event)
    {
      
      if (Yii::$app->request->isAjax) {
        
        Person::updateAll(['group_id' => null]);
        
        foreach ($_POST['group'] as $groupId => $ids) {
          Person::updateAll(['group_id' => $groupId], ['id' => $ids]);
        }
        
        return true;
        
      }
      
      $group = new Group;
      $group->event_id = $event->id;

      if ($group->load($_POST)) {

        if ($group->save()) {
          $group = new Group;
        } else { 

        }

      }

      $person = new Person;
      $person->event_id = $event->id;

      if ($person->load($_POST)) {

        if ($person->save()) {
          $person = new Person;
        } else {

        }

      }
      
      return $this->render('guests', [
        'event' => $event,
        'group' => $group,
        'person' => $person
      ]);
      
    }
    
    public function tabTables($event)
    {
      
      if (Yii::$app->request->isAjax) {
        
        Person::updateAll(['table_id' => null]);

        foreach ($_POST['table'] as $tableId => $ids) {
          
          foreach ($ids as $position => $id) {
            Person::updateAll(['table_id' => $tableId, 'position' => $position], ['id' => $id]); 
          }
          
        }
        
        return true;
        
      }
      
      $table = new Table;
      $table->event_id = $event->id;

      if ($table->load($_POST)) {

        if ($table->save()) {
          $table = new Table;
        } else {

        }

      }
      
      return $this->render('tables', [
        'event' => $event,
        'table' => $table
      ]);
      
    }
    
  }
