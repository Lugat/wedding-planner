<?php

  namespace app\models;

  use Yii;
  use yii\db\ActiveRecord;
  
  class Person extends ActiveRecord
  {

    public static function tableName()
    {
      return '{{%person}}';
    }

    public function rules()
    {
      return [
        [['event_id', 'name'], 'required'],
        [['event_id', 'group_id', 'table_id', 'position', 'optional', 'child', 'confirmed'], 'integer'],
        [['comment'], 'string'],
        [['name'], 'string', 'max' => 128],
        [['event_id', 'name'], 'unique', 'targetAttribute' => ['event_id', 'name']],
      ];

    }
    
    public function attributeLabels()
    {
      return [
        'id' => 'ID',
        'event_id' => 'Event ID',
        'group_id' => 'Group ID',
        'table_id' => 'Table ID',
        'position' => 'Position',
        'name' => 'Name',
        'comment' => 'Kommentar',
        'optional' => 'ist optional',
        'child' => 'ist Kind',
        'confirmed' => 'ist bestätigt',
      ];

    }
    
    public function getGroup()
    {
      return $this->hasOne(Group::className(), ['id' => 'group_id']);
    }

  }