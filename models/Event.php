<?php

  namespace app\models;

  use Yii;

  class Event extends \yii\db\ActiveRecord
  {

    public $options = [];

    public static function tableName()
    {
      return '{{%event}}';
    }

    public function rules()
    {
      return [
        [['uid', 'title'], 'required'],
        [['comment'], 'string'],
        [['uid'], 'string', 'max' => 32],
        [['title'], 'string', 'max' => 64],
        [['uid'], 'unique'],
        [['options'], 'safe']
      ];

    }

    public function attributeLabels()
    {
      return [
        'id' => 'ID',
        'uid' => 'UID',
        'title' => 'Title',
        'comment' => 'Comment',
      ];

    }
    
    public function beforeValidate()
    {
      
      if (parent::beforeValidate()) {
      
        if ($this->isNewRecord || isset($this->new_email)) { 
          $this->uid = md5(Yii::$app->security->generateRandomString());
        }

        return true;

      }
      
      return false;
      
    }
    
    public function afterSave($insert, $changedAttributes)
    {
      
      parent::afterSave($insert, $changedAttributes);
      
      if (!empty($this->options)) {

        Yii::$app->db->createCommand()->delete('{{%option}}', ['event_id' => $this->id])->execute();
        
        $rows = [];
        foreach ($this->options as $key => $value) {
          $rows[] = [$this->id, $key, $value];
        }
        
        Yii::$app->db->createCommand()->batchInsert('{{%option}}', ['event_id', 'key', 'value'], $rows)->execute();
      
      }
      
    }
    
    public function getOption($key)
    {
            
      return Yii::$app->db->createCommand('SELECT `value` FROM {{%option}} WHERE `event_id` = :eventId AND `key` = :key', [
        ':eventId' => $this->id,
        ':key' => $key,
      ])->queryScalar();
            
    }
    
    public function getPeople()
    {
      return $this->hasMany(Person::className(), ['event_id' => 'id'])->orderBy(['group_id' => SORT_ASC, 'name' => SORT_ASC]);
    }
    
    public function getPeopleWithoutGroup()
    {
      return $this->hasMany(Person::className(), ['event_id' => 'id'])->andWhere(['group_id' => null])->orderBy(['name' => SORT_ASC]);
    }
    
    public function getPeopleWithoutTable()
    {
      return $this->hasMany(Person::className(), ['event_id' => 'id'])->andWhere(['table_id' => null])->orderBy(['group_id' => SORT_ASC, 'name' => SORT_ASC]);
    }  
    
    public function getGroups()
    {
      return $this->hasMany(Group::className(), ['event_id' => 'id']);
    }
    
    public function getTables()
    {
      return $this->hasMany(Table::className(), ['event_id' => 'id']);
    } 

  }