<?php

  namespace app\modules\my\controllers;

  use Yii;
  
  use app\modules\my\components\Controller;
  use app\models\Budget;

  class BudgetController extends Controller
  {
    
    public function actionIndex()
    { 
      
      return $this->render('index', [
        'event' => $this->event,
        'budget' => new Budget,
      ]);
      
    }
    
    public function actionCreate()
    {
      
      $budget = new Budget;
      $budget->event_id = $this->event->id;

      if ($budget->load($_POST)) {

        if ($budget->save()) {
          
          Yii::$app->session->addFlash('success', 'Der Kostenpunkt wurde hinzugefügt.');
          
          $budget = new Budget;
          
        } else {
          
          Yii::$app->session->addFlash('danger', 'Der Kostenpunkt konnte nicht hinzugefügt werden.');
          
        }

      }
      
      return $this->redirect(['index']);
      
    }
    
    protected function getBudget($id)
    {
      return Budget::findOne(['event_id' => $this->event->id, 'id' => $id]);
    }
    
    public function actionUpdate($id)
    {
      
      $budget = $this->getBudget($id);
      
      if ($budget->load($_POST)) {

        if ($budget->update() !== false) {
          
          Yii::$app->session->addFlash('success', 'Der Kostenpunkt wurde aktualisiert.');
          
          return $this->redirect(['index']);
          
        } else {
          
          Yii::$app->session->addFlash('danger', 'Der Kostenpunkt konnte nicht aktualisiert werden.');

        }

      } 
      
      return $this->render('update', [
        'budget' => $budget
      ]);
      
    }
    
    public function actionDelete($id)
    {
      return (bool) $this->getPerson($id)->delete();
    }
    
  }