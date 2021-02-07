<?php

  namespace app\modules\my\controllers;

  use Yii;
  
  use app\modules\my\components\Controller;
  use app\models\Table;

  class TableController extends Controller
  {


    public function actionIndex()
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
      
      return $this->render('index', [
        'event' => $this->event,
        'table' => new Table
      ]);
      
    }
    
    public function actionCreate()
    {
      
      $table = new Table;
      $table->event_id = $this->event->id;

      if ($table->load($_POST)) {

        if ($table->save()) {
          $table = new Table;
        } else {

        }

      }
      
      return $this->redirect(['index']);
      
    }
    
    public function actionDelete($id)
    {
      
      Table::findOne(['event_id' => $this->event->id, 'id' => $id])->delete();
      
      return $this->redirect(['index']);
      
    }
    
  }
      