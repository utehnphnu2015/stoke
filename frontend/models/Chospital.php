<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "chospital".
 *
 * @property string $hospcode
 * @property string $hospname
 * @property string $hosptype
 * @property string $address
 * @property string $road
 * @property string $mu
 * @property string $subdistcode
 * @property string $distcode
 * @property string $provcode
 * @property string $postcode
 * @property string $hoscodenew
 * @property string $bed
 * @property string $level_service
 * @property string $bedhos
 */
class Chospital extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'chospital';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['hospcode'], 'required'],
            [['hospcode', 'postcode', 'bed', 'bedhos'], 'string', 'max' => 5],
            [['hospname', 'level_service'], 'string', 'max' => 255],
            [['hosptype', 'mu', 'subdistcode', 'distcode', 'provcode'], 'string', 'max' => 2],
            [['address', 'road'], 'string', 'max' => 50],
            [['hoscodenew'], 'string', 'max' => 9]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'hospcode' => 'Hospcode',
            'hospname' => 'Hospname',
            'hosptype' => 'Hosptype',
            'address' => 'Address',
            'road' => 'Road',
            'mu' => 'Mu',
            'subdistcode' => 'Subdistcode',
            'distcode' => 'Distcode',
            'provcode' => 'Provcode',
            'postcode' => 'Postcode',
            'hoscodenew' => 'Hoscodenew',
            'bed' => 'จำนวนเตียง',
            'level_service' => 'ระดับการบริการ',
            'bedhos' => 'Bedhos',
        ];
    }
}
