<?php

  namespace app\modules\my\controllers;

  use Yii;
  
  use app\modules\my\components\Controller;
  use app\models\Table;
  use app\models\Person;

  class TableController extends Controller
  {
    
    public function actionIndex()
    {
      
      if (Yii::$app->request->isAjax) {
        
        Person::updateAll(['event_id' => $this->event->id, 'table_id' => null]);

        foreach ($_POST['table'] as $tableId => $ids) {
          
          foreach ($ids as $position => $id) {
            Person::updateAll(['table_id' => $tableId, 'position' => $position], ['event_id' => $this->event->id, 'id' => $id]); 
          }
          
        }
        
        return true;
        
      }
      
      $table = new Table;
      $table->places = Yii::$app->params['defaultPlaces'];
      
      return $this->render('index', [
        'event' => $this->event,
        'table' => $table
      ]);
      
    }
    
    public function actionCreate()
    {
      
      $table = new Table;
      $table->event_id = $this->event->id;

      if ($table->load($_POST)) {

        if ($table->save()) {
          
          Yii::$app->session->addFlash('success', 'Der Tisch wurde erstellt.');
          
          $table = new Table;
          
        } else {
          
          Yii::$app->session->addFlash('danger', 'Der Tisch konnte nicht erstellt werden.');

        }

      }
      
      return $this->redirect(['index']);
      
    }
    
    protected function getTable($id)
    {
      return Table::findOne(['event_id' => $this->event->id, 'id' => $id]);
    }
    
    public function actionUpdate($id)
    {
      
      $table = $this->getTable($id);
      
      if ($table->load($_POST)) {

        if ($table->update() !== false) {
          
          Yii::$app->session->addFlash('success', 'Der Tisch wurde aktualisiert.');
          
          return $this->redirect(['index']);
          
        } else {
          
          Yii::$app->session->addFlash('danger', 'Der Tisch konnte nicht aktualisiert werden.');

        }

      } 
      
      return $this->render('update', [
        'table' => $table
      ]);
      
    }
    
    public function actionDelete($id)
    {
      
      $this->getTable($id)->delete();
      
      Yii::$app->session->addFlash('success', 'Die Tisch wurde gelöscht.');
      
      return $this->redirect(['index']);
      
    }
    
  }
      