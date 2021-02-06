<?php

  namespace app\models;

  use Yii;

  class Table extends \yii\db\ActiveRecord
  {

    public static function tableName()
    {
      return '{{%table}}';

    }

    public function rules()
    {
      return [
        [['event_id', 'title'], 'required'],
        [['event_id', 'places'], 'integer'],
        [['comment'], 'string'],
        [['title'], 'string', 'max' => 64],
        [['event_id', 'title'], 'unique', 'targetAttribute' => ['event_id', 'title']],
      ];

    }

    public function attributeLabels()
    {
      return [
        'id' => 'ID',
        'event_id' => 'Event ID',
        'title' => 'Title',
        'comment' => 'Comment',
        'places' => 'Places',
      ];

    }   
    
    public function getPeople()
    {
      return $this->hasMany(Person::className(), ['table_id' => 'id'])->orderBy(['position' => SORT_ASC]);
    }
    
    public function getState()
    {
      
      $people = count($this->people);
      
      if ($people === $this->places) {
        return 'success';
      }
      
      if ($people > $this->places) {
        return 'danger';
      }
      
      if ($people === 0) {
        return 'secondary';
      }
      
      return 'info';
            
    }

  }
