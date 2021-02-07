<?php

  namespace app\modules\my\components;
  
  use Yii;
  use yii\web\NotFoundHttpException;
  
  class Controller extends \yii\web\Controller
  {
    
    protected $event;
        
    public function behaviors()
    {
      
      return [
        'access' => [
          'class' => 'yii\filters\AccessControl',
          'rules' => [
            [
              'allow' => false,
              'roles' => ['*'],
            ], [
              'allow' => true,
              'roles' => ['@'],
            ],
          ],
          'denyCallback' => function() {
        
            $route = Yii::$app->user->isGuest ? '/site/index' : '/site/access-denied';
            
            return $this->redirect([$route]);
            
          }
        ],
      ];
        
    }
    
    public function init()
    {
      
      parent::init();
      
      $this->event = Yii::$app->user->identity;
      
    }
    
    public function notFound(string $message)
    {
      throw new NotFoundHttpException($message); 
    }
    
  }