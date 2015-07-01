<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "cdisease".
 *
 * @property string $diseasecode
 * @property string $disease
 * @property string $diseasethai
 * @property string $code504
 * @property string $code506
 * @property string $codechronic
 * @property string $diagcode
 * @property string $code298
 * @property string $code505
 * @property string $codemental
 * @property string $codedental
 * @property string $code19
 * @property string $codeca
 */
class Cdisease extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cdisease';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['diseasecode'], 'required'],
            [['diseasecode', 'diagcode'], 'string', 'max' => 7],
            [['disease', 'diseasethai'], 'string', 'max' => 255],
            [['code504', 'code506', 'code505', 'codemental', 'codedental', 'code19', 'codeca'], 'string', 'max' => 2],
            [['codechronic'], 'string', 'max' => 4],
            [['code298'], 'string', 'max' => 5]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'diseasecode' => 'Diseasecode',
            'disease' => 'Disease',
            'diseasethai' => 'Diseasethai',
            'code504' => 'รหัสกลุ่มโรค 504',
            'code506' => 'รหัสกลุ่มโรคระบาดวิทยา 506',
            'codechronic' => 'รหัสกลุ่มโรคเรื้อรัง NCD',
            'diagcode' => 'รหัส icd-10 ไม่มีจุด',
            'code298' => 'รหัสกลุ่มโรค298กลุ่มโรค',
            'code505' => 'รหัสกลุ่มโรค505 (ผู้ป่วยใน)',
            'codemental' => 'รหัสกลุ่มโรคจิต',
            'codedental' => 'รหัสกลุ่มโรคฟัน',
            'code19' => 'กลุ่มโรคอุบัติเหตุ 19 สาเหตุ',
            'codeca' => 'Codeca',
        ];
    }
}
