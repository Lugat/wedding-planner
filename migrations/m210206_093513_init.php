<?php

  use yii\db\Migration;

  class m210206_093513_init extends Migration
  {
    
    public function safeUp()
    {
      
      $this->createTable('{{%event}}', [
        'id' => $this->primaryKey(),
        'uid' => $this->string(32)->unique()->notNull(),
        'title' => $this->string(64)->notNull(),
        'comment' => $this->text(),
      ]);
      
      $this->createTable('{{%option}}', [
        'event_id' => $this->integer()->notNull(),
        'key' => $this->string(32)->notNull(),
        'value' => $this->string(255)->notNull(),
        'PRIMARY KEY(`event_id`, `key`)'
      ]);
      
      $this->createTable('{{%group}}', [
        'id' => $this->primaryKey(),
        'event_id' => $this->integer()->notNull(),
        'title' => $this->string(64)->notNull(),
        'comment' => $this->text(),
        'color' => $this->string(7)->notNull(),
        'UNIQUE KEY (`event_id`, `title`)'
      ]);
      
      $this->createTable('{{%table}}', [
        'id' => $this->primaryKey(),
        'event_id' => $this->integer()->notNull(),
        'title' => $this->string(64)->notNull(),
        'comment' => $this->text(),
        'people' => $this->integer(2)->notNull()->defaultValue(8),
        'UNIQUE KEY(`event_id`, `title`)'
      ]);
      
      $this->createTable('{{%person}}', [
        'id' => $this->primaryKey(),
        'event_id' => $this->integer()->notNull(),
        'group_id' => $this->integer(),
        'table_id' => $this->integer(),
        'position' => $this->integer(2)->defaultValue(0),
        'name' => $this->string(128)->notNull(),
        'comment' => $this->text(),
        'optional' => $this->tinyInteger(1)->notNull()->defaultValue(0),
        'confirmed' => $this->tinyInteger(1)->notNull()->defaultValue(0),
        'UNIQUE KEY(`group_id`, `name`)'
      ]);

      
    }
    
    public function safeDown()
    {
      return false;
    }
    
  }