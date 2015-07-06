<?php
$this->title = 'จำนวนผู้ป่วยStoke';
$this->params['breadcrumbs'][]=$this->title;
use yii\grid\GridView;
use miloschuman\highcharts\Highcharts;
use yii\helpers\Html;


echo \kartik\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'responsive' => TRUE,
    'hover' => true,
    'floatHeader' => true,
    'panel' => [
        'heading'=>'จำนวนผู้ป่วย Stoke แยกรายตำบล',
        'before' => '',
        'type' => \kartik\grid\GridView::TYPE_SUCCESS,
       
    ],
    'columns'=>[
        ['class'=>'yii\grid\SerialColumn'],
        [
            'label'=>'อำเภอ',
            'attribute'=>'ampurname'
        ],
        [
            'label'=>'ตำบล',
            'attribute'=>'tambonname'
        ],
        [
            'label'=>'จำนวน',
            'attribute'=>'total'
        ],
       ],

    
]);

echo Highcharts::widget([
    'options'=>[
        'title'=>['text'=>'จำนวนผู้ป่วยStoke'],
        'xAxis'=>[
            'categories'=>$tambonname
        ],
        'yAxis'=>[
            'title'=>['text'=>'จำนวน(คน)']
        ],
        'series'=>[
            [//'type'=>'line',
                'name'=>'จำนวน',
                'data'=>$total,
            ],
            //['name' => 'ผลรวม', 'data' => $sumadj],
            //['name' => 'LOS', 'data' => $los],
        ]
    ]
]);
