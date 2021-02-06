<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%option}}".
 *
 * @property int $event_id
 * @property string $key
 * @property string $value
 */
class Option extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%option}}';
    }

    /**
     * {@inheritdoc}
     */
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

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'event_id' => 'Event ID',
            'key' => 'Key',
            'value' => 'Value',
        ];
    }
}
