<?php
$this->title = 'จำนวนผู้ป่วย Stroke ตามช่วงเวลา';
$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['report/index']];
$this->params['breadcrumbs'][]=$this->title;
use yii\grid\GridView;
use miloschuman\highcharts\Highcharts;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use frontend\models\Campur;
use frontend\models\Ctambon;
use kartik\widgets\Select2;
use yii\widgets\Pjax;

?>
<div class='well'>
    <form method="POST">
        ระหว่างวันที่:
        <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-5">
            <?php
        echo yii\jui\DatePicker::widget([
            'name' => 'date1',
            'value' => $date1,
            'language' => 'th',
            'dateFormat' => 'yyyy-MM-dd',
            'clientOptions' => [
                'changeMonth' => true,
                'changeYear' => true,
            ],
            'options'=>[
                'class'=>'form-control'
            ],
        ]);
        ?>
        ถึงวันที่:
        <?php
        echo yii\jui\DatePicker::widget([
            'name' => 'date2',
            'value' => $date2,
            'language' => 'th',
            'dateFormat' => 'yyyy-MM-dd',
            'clientOptions' => [
                'changeMonth' => true,
                'changeYear' => true,
            ],
            'options'=>[
                'class'=>'form-control'
            ],
            
        ]);
        ?>
        </div>
         <div class="col-xs-4 col-sm-4 col-md-4">
            <?php
         $list= ArrayHelper::map(Campur::find()->all(), 'ampurname', 'ampurname');
            echo Select2::widget([
            'name' => 'ampurname',
            'data' => $list,
            'value'=>$ampurname,
            'size' => Select2::MEDIUM,
            'options' => ['placeholder' => 'เลือก อำเภอ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
            ?>
        </div>
              
            
            
       <div class="col-xs-4 col-sm-4 col-md-2">
            <button class='btn btn-danger'>ประมวลผล</button>
        </div>    
         
</div>
        
    </form>
    
</div>
<?php Pjax::begin();?> 
<?php
echo \kartik\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => '-'],
    'responsive' => TRUE,
    'hover' => true,
    'floatHeader' => FALSE,
    'panel' => [
        'heading'=>'รายชื่อผู้ป่วย Stroke แยกรายตำบล',
        'before' => '',
        'type' => \kartik\grid\GridView::TYPE_SUCCESS,
       
    ],
    'columns'=>[
        ['class'=>'yii\grid\SerialColumn'],
        
        [
            'label'=>'ตำบล',
            'attribute'=>'tambonname'
        ],
        [
            'label'=>'ชื่อ-สกุล',
            'attribute'=>'name'
        ],
        [
            'label'=>'ที่อยู่',
            'attribute'=>'addr'
        ],
        [
            'label'=>'ICD10',
            'attribute'=>'pdx'
        ],
       ],    
]);

//echo Highcharts::widget([
//    'options'=>[
//        'title'=>['text'=>'แสดงจำนวนผู้ป่วย Stroke แยกรายตำบล'],
//        'xAxis'=>[
//            'categories'=>$tambonname
//        ],
//        'yAxis'=>[
//            'title'=>['text'=>'จำนวน(คน)']
//        ],
//        'series'=>[
//            ['type'=>'column',
//                'name'=>'จำนวน',
//                'data'=>$total,
//            ],
//            
//        ]
//    ]
//]);
?>

</div>