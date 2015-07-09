<?php
$this->title = 'จำนวนผู้ป่วย STOKE รายปี ตามเพศ';
$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['report/index']];
$this->params['breadcrumbs'][]=$this->title;
use yii\grid\GridView;
use miloschuman\highcharts\Highcharts;
use yii\helpers\Html;

echo Highcharts::widget([
    'options'=>[        
        'title'=>['text'=>'จำนวนผู้ป่วย STOKE รายปี ตามเพศ'],
        'xAxis'=>[
            'categories'=>$yy
        ],
        'yAxis'=>[
            'title'=>['text'=>'จำนวน(คน)']
        ],
        'series'=>[
            [
                'type'=>'column',
                'name'=>'เพศชาย',
                'data'=>$m,
            ],
            [
                'type'=>'column',
                'name'=>'เพศหญิง',
                'data'=>$fe,
            ],
            
            
        ]
    ]
]);

echo \kartik\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'responsive' => TRUE,
    'hover' => true,
    'floatHeader' => FALSE,
    'panel' => [
        'heading'=>'จำนวนผู้ป่วย Stoke แยกรายปี ตามเพศ',
        'before' => '',
        'type' => \kartik\grid\GridView::TYPE_SUCCESS,
       
    ],
    'columns'=>[
        ['class'=>'yii\grid\SerialColumn'],
        [
            'label'=>'ปี',
            'attribute'=>'yy'
        ],
        
        [
            'label'=>'เพศชาย',
            'attribute'=>'m'
        ],
         [
            'label'=>'เพศหญิง',
            'attribute'=>'fe'
        ],
        
       ],    
]);