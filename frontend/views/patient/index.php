<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\widgets\Pjax;
use kartik\dynagrid\DynaGrid;
use kartik\grid\GridView;



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
        <?= Html::a('<i class="glyphicon glyphicon-plus"></i> บันทึกข้อมูล', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin();?> 
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
                    'width'=>'160px',
                    'headerOptions'=>['class'=>'text-center'],
                    'contentOptions'=>['class'=>'text-center'],  
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
              ],  
              [
                  'attribute'=>'tambon',
                  'value'=>'tambons.tambonname',
                  'headerOptions'=>['class'=>'text-center'],
              ],
        [
                     'attribute'=>'pdx', 
                     'headerOptions'=>['class'=>'text-center'],
                     'contentOptions'=>['class'=>'text-center'], 
                 ],
         [
                  'attribute'=>'hospcode',
                  'value'=>'hospcodes.hospname'
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
