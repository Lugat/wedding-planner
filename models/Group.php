<?php

  namespace app\models;

  use Yii;
  use yii\db\ActiveRecord;

  class Group extends ActiveRecord
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
        'title' => 'Titel',
        'comment' => 'Kommentar',
        'color' => 'Farbe',
      ];

    }
    
    public function getPeople()
    {
      return $this->hasMany(Person::className(), ['group_id' => 'id']);
    }
    
    public function afterDelete()
    {
      return Person::updateAll(['group_id' => null], ['group_id' => $this->id]);
    }

  }
