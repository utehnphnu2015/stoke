<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\widgets\Pjax;
use kartik\dynagrid\DynaGrid;
use kartik\grid\GridView;
use yii\bootstrap\Modal;
use frontend\models\Campur;



/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PatientSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ผู้ป่วย STOKE ที่admit จ.พิษณุโลก';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="patient-index">

    <h2><?= Html::encode($this->title) ?></h2>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::button('<i class="glyphicon glyphicon-plus"></i> บันทึกข้อมูลผู้ป่วย STOKE', [
            'value'=>Url::to('index.php?r=patient/create'),'class' => 
            'btn btn-success','id'=>'modalButton2']) ?>
    </p>
    
    <?php
        Modal::begin([
            'header'=>'<h4>บันทึกข้อมูลผู้ป่วย STOKE</h4>',
            'id'=>'modal2',
            'size'=>'modal-lg',
            'options'=>[
                'tabindex' => false
            ]
                ]);
        echo "<div id='modalContent2'></div>";
        Modal::end();
    ?> 

    <?php Pjax::begin(['id'=>'stoke-gridview']);?> 
    <?php echo \kartik\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel'=>$searchModel,    
    'responsive' => TRUE,
    'hover' => true,    
    'panel' => [
        'before' => '',
        'type' => \kartik\grid\GridView::TYPE_SUCCESS,        
    ],
    
    'columns' => [
        ['class'=>'kartik\grid\SerialColumn'],

            //'pid',            
            //'birth',
            //'hn',
           // 'an',
            
        [
                    'attribute'=>'name',
                    'width'=>'180px',
                    'headerOptions'=>['class'=>'text-center'],                    
                 ], 
             //'cid',
                
                [
                    'attribute'=>'village', 
                    'headerOptions'=>['class'=>'text-center'],
                    'contentOptions'=>['class'=>'text-center'],  
                 ], 
                [
                  'attribute'=>'address', 
                  'headerOptions'=>['class'=>'text-center'],
                  'contentOptions'=>['class'=>'text-center'],  
              ], 
                
              [
                  'attribute'=>'amphur',
                  'value'=>'ampurs.ampurname',
                  'filter'=>ArrayHelper::map(\frontend\models\Campur::find()->orderBy('ampurname')->asArray()->all(), 'ampurname', 'ampurname'),  
                    'vAlign'=>'middle',
                    'width'=>'160px',
                    'filterType'=>GridView::FILTER_SELECT2,           
                    'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                    //'format'=>'raw'    
                ],
                  'headerOptions'=>['class'=>'text-center'],
                  'filterInputOptions'=>['placeholder'=>'เลือก อำเภอ'],
              ], 
              [
                  'attribute'=>'tambon',
                  'value'=>'tambons.tambonname',
                  'filter'=>ArrayHelper::map(\frontend\models\Ctambon::find()->orderBy('tambonname')->asArray()->all(), 'tambonname', 'tambonname'),  
                    'vAlign'=>'middle',
                    'width'=>'140px',
                    'filterType'=>GridView::FILTER_SELECT2,           
                    'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                    //'format'=>'raw'    
                ],
                  'headerOptions'=>['class'=>'text-center'],
                  'filterInputOptions'=>['placeholder'=>'เลือก ตำบล'],  
              ],  
             
        [
                     'attribute'=>'pdx', 
                     'headerOptions'=>['class'=>'text-center'],
                     'contentOptions'=>['class'=>'text-center'], 
                 ],
        
               [
                  'attribute'=>'hospcode',
                   'value'=>'hospcodes.hospname',
                  'filter'=>ArrayHelper::map(\frontend\models\Chospital::find()->orderBy('hospcode')->asArray()->all(), 'hospname', 'hospname'),  
                    'vAlign'=>'middle',
                    'width'=>'200px',
                    'filterType'=>GridView::FILTER_SELECT2,           
                    'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                    //'format'=>'raw'    
                ],
                  'headerOptions'=>['class'=>'text-center'],
                  'filterInputOptions'=>['placeholder'=>'เลือก สถานพยาบาล'], 
              ],
              [
                  'attribute'=>'discharge_type',
                   'value'=>'discharge.discharge_name',
                  'filter'=>ArrayHelper::map(\frontend\models\Cdischarcetype::find()->orderBy('discharge_id')->asArray()->all(), 'discharge_name', 'discharge_name'),  
                    'vAlign'=>'middle',
                    'width'=>'100px',
                    'filterType'=>GridView::FILTER_SELECT2,           
                    'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                    //'format'=>'raw'    
                ],
                  'headerOptions'=>['class'=>'text-center'],
                  'filterInputOptions'=>['placeholder'=>'เลือก การจำหน่าย'], 
              ],
              //'date_addmit',
             //'date_discharge',
             //'ward',             
             //'discharge_type',
             //'admit_day',
             //'province',
            // 'd_update',
            // 'note1',
            // 'note2',
            // 'note3',
            // 'note4',
            [
                'class' => 'yii\grid\ActionColumn',
                'options'=>['style'=>'width:120px;'],
                'template'=>'<div class="btn-group btn-group-sm" role="group" aria-label="...">{view}{update}</div>',
                'buttons'=>[
                    'view'=>function($url,$model,$key){
                        return Html::a('<i class="glyphicon glyphicon-eye-open"></i>',$url,['class'=>'btn btn-default']);
                    }, 
                    'update'=>function($url,$model,$key){
                        return Html::a('<i class="glyphicon glyphicon-pencil"></i>',$url,['class'=>'btn btn-default']);
                    },
//                    'delete'=>function($url,$model,$key){
//                         return Html::a('<i class="glyphicon glyphicon-trash"></i>', $url,[
//                                'title' => Yii::t('yii', 'Delete'),
//                                'data-confirm' => Yii::t('yii', 'คุณต้องการลบไฟล์นี้?'),
//                                'data-method' => 'post',
//                                'data-pjax' => '0',
//                                'class'=>'btn btn-default'
//                                ]);
//                    }
                ]
            ],         
        ]
    
]);
?>  

<?php Pjax::end();?>

</div>
