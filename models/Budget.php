<?php

  namespace app\models;

  use Yii;

  class Budget extends \yii\db\ActiveRecord
  {
    
    public static function tableName()
    {
      return '{{%budget}}';
    }

    public function rules()
    {
      return [
        [['event_id', 'title', 'price'], 'required'],
        [['event_id', 'per_person'], 'integer'],
        [['price'], 'number'],
        [['title'], 'string', 'max' => 128],
        [['event_id', 'title'], 'unique', 'targetAttribute' => ['event_id', 'title']],
      ];
    }

    public function attributeLabels()
    {
      return [
        'id' => 'ID',
        'event_id' => 'Event ID',
        'title' => 'Titel',
        'price' => 'Preis',
        'per_person' => 'Preis pro Gast',
      ];
    }
    
    public function getEvent()
    {
      return $this->hasOne(Event::className(), ['id' => 'event_id']);
    } 
    
    public function getTotalPrice()
    {
      return $this->price * ($this->per_person ? count($this->event->people) : 1);
    }
    
  }
