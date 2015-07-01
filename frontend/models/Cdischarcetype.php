<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "cdischarce_type".
 *
 * @property string $discharge_id
 * @property string $discharge_name
 */
class Cdischarcetype extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cdischarce_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['discharge_id'], 'required'],
            [['discharge_id'], 'string', 'max' => 2],
            [['discharge_name'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'discharge_id' => 'Discharge ID',
            'discharge_name' => 'Discharge Name',
        ];
    }
}
