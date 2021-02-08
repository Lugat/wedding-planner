<?php

  namespace app\models;

  use Yii;
  use yii\db\ActiveRecord;
  use yii\web\IdentityInterface;
  use yii\helpers\ArrayHelper;

  class Event extends ActiveRecord implements IdentityInterface
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
        [['uid'], 'string', 'max' => 8],
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
        'title' => 'Titel',
        'comment' => 'Kommentar',
      ];

    }
    
    public static function findIdentity($id)
    {
      return self::findOne(['uid' => $id]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    { 
      return null;
    }
    
    public function getId()
    {
      return $this->uid;
    }
    
    public function getAuthKey()
    {
      return null;
    }

    public function validateAuthKey($authKey)
    {
      return true;
    }
    
    public function beforeValidate()
    {
      
      if (parent::beforeValidate()) {
      
        if ($this->isNewRecord) { 
          $this->uid = Yii::$app->security->generateRandomString(8);
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
    
    public function afterFind()
    {
      
      parent::afterFind();
            
      $options = Yii::$app->db->createCommand('SELECT `key`, `value` FROM {{%option}} WHERE `event_id` = :eventId', [
        ':eventId' => $this->id,
      ])->queryAll();
      
      $this->options = ArrayHelper::map($options, 'key', 'value');
  
    }
    
    public function getPeople()
    {
      return $this->hasMany(Person::className(), ['event_id' => 'id'])->orderBy(['group_id' => SORT_ASC, 'name' => SORT_ASC]);
    }
    
    public function getAdults()
    {
      return $this->getPeople()->andWhere(['child' => 0]);
    }
    
    public function getChildren()
    {
      return $this->getPeople()->andWhere(['child' => 1]);
    }
    
    public function getOptional()
    {
      return $this->getPeople()->andWhere(['optional' => 1]);
    }
    
    public function getConfirmed()
    {
      return $this->getPeople()->andWhere(['confirmed' => 1]);
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