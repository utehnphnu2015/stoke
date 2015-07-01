<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "campur".
 *
 * @property string $ampurcode
 * @property string $ampurname
 * @property string $ampurcodefull
 * @property string $changwatcode
 * @property string $flag_status
 */
class Campur extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'campur';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ampurcode', 'ampurcodefull', 'changwatcode'], 'required'],
            [['ampurcode', 'changwatcode'], 'string', 'max' => 2],
            [['ampurname'], 'string', 'max' => 255],
            [['ampurcodefull'], 'string', 'max' => 4],
            [['flag_status'], 'string', 'max' => 1]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ampurcode' => 'Ampurcode',
            'ampurname' => 'Ampurname',
            'ampurcodefull' => 'Ampurcodefull',
            'changwatcode' => 'Changwatcode',
            'flag_status' => 'สถานนะของพื้นที่ 0=ปกติ 1=เลิกใช้(แยก/ย้ายไปพื้นที่อื่น)',
        ];
    }
    public function getTambon(){
        return $this->hasMany(Ctambon::className(), ['ampurcode'=>'ampurcodefull']);
    }
}
