<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\data\ArrayDataProvider;
use common\models\User;
use yii\filters\AccessControl;
use common\components\AccessRule;

/**
 * PatientController implements the CRUD actions for Patient model.
 */
class ReportController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access'=>[
                'class'=>AccessControl::className(),
                'only'=> ['index','report1','report2','report3','report4','report5','report6','indivreport3'],
                'ruleConfig'=>[
                    'class'=>AccessRule::className()
                ],
                'rules'=>[
                    [
                        'actions'=>['index','report1','report2','report3','report4','report5','report6','indivreport3'],
                        'allow'=> true,
                        'roles'=>[
                            User::ROLE_USER,
                            User::ROLE_MODERATOR,
                            User::ROLE_ADMIN

                        ]
                    ],
                    
                ]
            ]
        ];
    }
    
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
       $connection = Yii::$app->db;
        $datas = $connection->createCommand('
            SELECT a.ampurname ,p.amphur,COUNT(p.pid) as total  FROM patient  p
            LEFT JOIN campur a on a.ampurcodefull=p.amphur
            LEFT JOIN ctambon b on b.tamboncodefull=p.tambon            
            GROUP BY a.ampurcodefull
            ')->queryAll();
        
        
        $dataProvider = new ArrayDataProvider([
            'allModels'=>$datas,
            'sort'=>[
                'attributes'=>['ampurname','total'],                  
            ],
            'pagination' =>false,
        ]);
        return $this->render('report3',[
            'dataProvider'=>$dataProvider,
          
     ]);

    }
    public function actionIndivReport3($ampurcode = null){
        $sql = "SELECT b.tambonname,b.tamboncodefull,p.amphur,COUNT(p.pid) as total  FROM patient  p
            LEFT JOIN campur a on a.ampurcodefull=p.amphur
            LEFT JOIN ctambon b on b.tamboncodefull=p.tambon
            WHERE  p.amphur='$ampurcode'
            GROUP BY b.tamboncodefull
            ORDER BY b.tamboncodefull ";
        $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        //print_r($rawData);
        //return;

        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }

        return $this->render('indivreport3', [
                    'rawData' => $rawData,
                    'sql' => $sql,
                    'ampurcode' => $ampurcode,
                   
                    
        ]);
    }
    
    public function actionReport4(){
        return $this->render('report4');
    }
     public function actionReport5(){
        $connection = Yii::$app->db;
        $datas = $connection->createCommand('
            select year(p.date_addmit) as yy
            , sum((year(now())-year(p.birth)) <=31 )as a
            , sum((year(now())-year(p.birth)) between 31 and 40  )as b
            , sum((year(now())-year(p.birth)) between 41 and 50  )as c
            , sum((year(now())-year(p.birth)) between 51 and 60  )as d
            , sum((year(now())-year(p.birth)) >61  )as e
            from patient p
            group by year(p.date_addmit) order by yy DESC
            ')->queryAll();
        
        
        $dataProvider = new ArrayDataProvider([
            'allModels'=>$datas,
            'sort'=>[
                'attributes'=>['ampurname','total'],                  
            ],
            'pagination' =>false,
        ]);
        return $this->render('report5',[
            'dataProvider'=>$dataProvider,
            //'ampurname'=>$ampurname,
            //'total'=>$total
     ]);
    }
    public function actionReport6(){
        $connection = Yii::$app->db;
        $data = $connection->createCommand('
           select year(p.date_addmit) as yy
            , sum((year(now())-year(p.birth)) <=31 )as a
            , sum((year(now())-year(p.birth)) between 31 and 40  )as b
            , sum((year(now())-year(p.birth)) between 41 and 50  )as c
            , sum((year(now())-year(p.birth)) between 51 and 60  )as d
            , sum((year(now())-year(p.birth)) >61  )as e
            from patient p
            group by year(p.date_addmit)
            ')->queryAll();
        //เตรียมข้อมูลส่งให้กราฟ
        for($i=0;$i<sizeof($data);$i++){
            $yy[] = $data[$i]['yy'];           
            $a[] = $data[$i]['a']*1;
            $b[] = $data[$i]['b']*1;
            $c[] = $data[$i]['c']*1;
            $d[] = $data[$i]['d']*1;
            $e[] = $data[$i]['e']*1;
        }
        
        $dataProvider = new ArrayDataProvider([
            'allModels'=>$data,
            'sort'=>[
                'attributes'=>['yy']
            ],
        ]);
        return $this->render('report6',[
            'dataProvider'=>$dataProvider,
            'yy'=>$yy,'a'=>$a,'b'=>$b,'c'=>$c,'d'=>$d,'e'=>$e,
        ]);
    }
}
    

        