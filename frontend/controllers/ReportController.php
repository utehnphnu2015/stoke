<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\data\ArrayDataProvider;

/**
 * PatientController implements the CRUD actions for Patient model.
 */
class ReportController extends Controller
{
    public $enableCsrfValidation = false;
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    public function actionReport1(){
       
        
        $connection = Yii::$app->db;
        $data = $connection->createCommand('
            SELECT a.ampurname ,b.tambonname,COUNT(p.pid) as total  FROM patient  p
            LEFT JOIN campur a on a.ampurcodefull=p.amphur
            LEFT JOIN ctambon b on b.tamboncodefull=p.tambon
            WHERE p.date_addmit BETWEEN "2015-01-01" AND "2015-07-31"
            GROUP BY b.tamboncodefull
            ')->queryAll();
        
        //เตรียมข้อมูลส่งให้กราฟ
         for($i=0;$i<sizeof($data);$i++){
             $tambonname[] = $data[$i]['tambonname'];
             $total[] = $data[$i]['total']*1;
             
         }
        
        $dataProvider = new ArrayDataProvider([
            'allModels'=>$data,
            'sort'=>[
                'attributes'=>['ampurname','tambonname','total'],                  
            ],
            'pagination' =>false,
        ]);
        return $this->render('report1',[
            'dataProvider'=>$dataProvider,
            'tambonname'=>$tambonname,
            'total'=>$total
     ]);
}
    
 public function actionReport2(){
        $date1 = "";
        $date2 = "";
        $ampurname = "";
       
        
        if (Yii::$app->request->isPost) {
            $date1 = $_POST['date1'];
            $date2 = $_POST['date2'];
            $ampurname = $_POST['ampurname'];
           
        }
        
        $sql = "SELECT b.tambonname ,p.name,CONCAT('บ้านเลขที่ ',p.address,'  หมู่ ' ,p.village,' ตำบล ' ,b.tambonname,'  อำเภอ',a.ampurname ) as addr 
            ,p.pdx FROM patient  p
            LEFT JOIN campur a on a.ampurcodefull=p.amphur
            LEFT JOIN ctambon b on b.tamboncodefull=p.tambon
            WHERE p.date_addmit BETWEEN '$date1' AND '$date2'
            AND a.ampurname='$ampurname'           
            ORDER BY b.tamboncodefull";
        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        
//        for($i=0;$i<sizeof($sql);$i++){
//             $tambonname[] = $sql[$i]['tambonname'];
//             $total[] = $sql[$i]['total']*1;
//             
//         }
         
        $dataProvider = new \yii\data\ArrayDataProvider([
            //'key' => 'ampurname',
            'allModels' => $rawData,
            'pagination' =>false,
            
        ]);
        //Yii::$app->session->setFlash('danger', 'รจำนวนผู้ป่วย Stoke แยกรายตำบล !');
        return $this->render('report2', [
                    'dataProvider' => $dataProvider,
                    'sql' => $sql,
                    'date1' => $date1,
                    'date2' => $date2,
                    'ampurname'=>$ampurname,
                    
//                    'total'=>$total
        ]);
    }
    public function actionReport3() {
        return $this->render('report3');
    }
}
    

        