<?php

  namespace app\models;

  use Yii;

  class Group extends \yii\db\ActiveRecord
  {

    public static function tableName()
    {
      return '{{%group}}';

    }

    public function rules()
    {
      return [
        [['event_id', 'title', 'color'], 'required'],
        [['event_id'], 'integer'],
        [['comment'], 'string'],
        [['title'], 'string', 'max' => 64],
        [['color'], 'string', 'max' => 7],
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
        'color' => 'Color',
      ];

    }
    
    public function getPeople()
    {
      return $this->hasMany(Person::className(), ['group_id' => 'id']);
    }

  }
