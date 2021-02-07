<?php

namespace app\models;

  use Yii;
  use yii\db\ActiveRecord;

  class Option extends \ActiveRecord
  {
    
    public static function tableName()
    {
      return '{{%option}}';
    }

    public function rules()
    {
      return [
        [['event_id', 'key', 'value'], 'required'],
        [['event_id'], 'integer'],
        [['key'], 'string', 'max' => 32],
        [['value'], 'string', 'max' => 255],
        [['event_id', 'key'], 'unique', 'targetAttribute' => ['event_id', 'key']],
      ];
    }
    
    public function attributeLabels()
    {
      return [
        'event_id' => 'Event ID',
        'key' => 'Key',
        'value' => 'Value',
      ];
    }
    
  }