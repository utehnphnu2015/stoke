<?php

namespace frontend\models;

use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\Json;
use yii\db\Expression;
use app\models\Cdisease;
use frontend\models\Campur;

/**
 * This is the model class for table "patient".
 *
 * @property integer $pid
 * @property string $name
 * @property string $birth
 * @property string $hn
 * @property string $an
 * @property string $cid
 * @property string $hospcode
 * @property string $date_addmit
 * @property string $date_discharge
 * @property string $ward
 * @property string $pdx
 * @property string $discharge_type
 * @property integer $admit_day
 * @property string $address
 * @property string $village
 * @property string $tambon
 * @property string $amphur
 * @property string $province
 * @property string $d_update
 * @property string $note1
 * @property string $note2
 * @property string $note3
 * @property string $note4
 * @property string $sex
 * @property string $age
 */
class Patient extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    
    const SEX_MEN = 1;
    const SEX_FEMEL = 2;
    
    
    public static $sexs = ['ชาย' => 'ชาย', 'หญิง'=> 'หญิง'];
    
    public static function tableName()
    {
        return 'patient';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['birth', 'date_addmit', 'date_discharge', 'd_update'], 'safe'],
            [['admit_day','age'], 'integer'],
            [['name', 'ward'], 'string', 'max' => 100],
            [['hn', 'an', 'cid'], 'string', 'max' => 17],
            [['hospcode','sex'], 'string', 'max' => 5],
            [['pdx', 'tambon'], 'string', 'max' => 6],
            [['discharge_type', 'village', 'province'], 'string', 'max' => 2],
            [['address'], 'string', 'max' => 50],
            [['amphur'], 'string', 'max' => 4],
            [['province'], 'default','value'=>65],
            [['note1', 'note2', 'note3', 'note4'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pid' => 'Pid',
            'name' => 'รายชื่อ',
            'age'=>'อายุ',
            'birth' => 'วันเกิด',
            'hn' => 'Hn',
            'an' => 'An',
            'cid' => 'บัตรประชาชน',
            'hospcode' => 'สถานพยาบาล',
            'date_addmit' => 'วันที่รับเข้าการรักษา',
            'date_discharge' => 'วันที่จำหน่าย',
            'ward' => 'แผนก(ตึกผู้ป่วย)',
            'pdx' => 'รหัสโรค',
            'discharge_type' => 'การจำหน่าย',
            'admit_day' => 'รวมวันนอน',
            'address' => 'ที่อยู่',
            'village' => 'หมู่ที่',
            'tambon' => 'ตำบล',
            'amphur' => 'อำเภอ',
            'province' => 'จังหวัด',
            'd_update' => 'D Update',
            'note1' => 'หมายเหตุ :',
            'note2' => 'Note2',
            'note3' => 'Note3',
            'note4' => 'Note4',
            'sex'=>'เพศ',
        ];
    }
    public static function itemAlias($type,$code=NULL) {
        $_items = array(
            'sex' => array(
                'ชาย' =>  'ชาย',
                'หญิง' => 'หญิง',
            ), 
         );
        

        if (isset($code)){
            return isset($_items[$type][$code]) ? $_items[$type][$code] : false;
        }
        else{         
            return isset($_items[$type]) ? $_items[$type] : false;    
        }
    }
    
    public function getHospcodes(){
        return $this->hasOne(Chospital::className(), ['hospcode'=>'hospcode']);
    }    
    public function getAmpurs(){
        return $this->hasOne(Campur::className(), ['ampurcodefull'=>'amphur']);
    }
    public function getTambons(){
        return $this->hasOne(Ctambon::className(), ['tamboncodefull'=>'tambon']);
    }
    public function getDischarge(){
        return $this->hasOne(Cdischarcetype::className(), ['discharge_id'=>'discharge_type']);
    }
    public function beforeSave($insert) {
        if ($this->isNewRecord) {
            $this->d_update = date('Y-m-d H:i:s');
        } else {
            $this->d_update = date('Y-m-d H:i:s');
        }
        return parent::beforeSave($insert);
    }
     public function getDate() {
        return date('Y-m-d H:i:s', $this->d_update);
    }
}
