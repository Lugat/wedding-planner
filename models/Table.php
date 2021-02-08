<?php

  namespace app\models;

  use Yii;
  use yii\db\ActiveRecord;

  class Table extends ActiveRecord
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
        'title' => 'Titel',
        'comment' => 'Kommentar',
        'places' => 'Sitzplätze',
      ];

    }   
    
    public function getPeople()
    {
      return $this->hasMany(Person::className(), ['table_id' => 'id'])->orderBy(['position' => SORT_ASC]);
    }
    
    public function afterDelete()
    {
      return Person::updateAll(['table_id' => null, 'position' => 0], ['table_id' => $this->id]);
    }

  }
