<?php
$this->title = 'จำนวนผู้ป่วย STOKE รายปี ตามกลุ่มอายุ';
$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['report/index']];
$this->params['breadcrumbs'][]=$this->title;
use yii\grid\GridView;
use miloschuman\highcharts\Highcharts;
use yii\helpers\Html;

echo Highcharts::widget([
    'options'=>[        
        'title'=>['text'=>'จำนวนผู้ป่วย STOKE รายปี ตามกลุ่มอายุ'],
        'xAxis'=>[
            'categories'=>$yy
        ],
        'yAxis'=>[
            'title'=>['text'=>'จำนวน(คน)']
        ],
        'series'=>[
            [
                'type'=>'column',
                'name'=>'ต่ำกว่า30ปี',
                'data'=>$a,
            ],
            [
                'type'=>'column',
                'name'=>'ระหว่าง31-40ปี',
                'data'=>$b,
            ],
            [
                'type'=>'column',
                'name'=>'ระหว่าง41-50ปี',
                'data'=>$c,
            ],
            [
                'type'=>'column',
                'name'=>'ระหว่าง51-60ปี',
                'data'=>$d,
            ],
            [
                'type'=>'column',
                'name'=>'มากกว่า 60ปีขึ้นไป',
                'data'=>$e,
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
        'heading'=>'จำนวนผู้ป่วย Stoke แยกรายปี ตามกลุ่มอายุ',
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
            'label'=>'อายุต่ำว่า<30ปี',
            'attribute'=>'a'
        ],
         [
            'label'=>'อายุ31-40ปี',
            'attribute'=>'b'
        ],
        [
            'label'=>'อายุ41-50ปี',
            'attribute'=>'c'
        ],
         [
            'label'=>'อายุ51-60ปี',
            'attribute'=>'d'
        ],
        [
            'label'=>'อายุ60>ปีขึ้นไป',
            'attribute'=>'e'
        ],
       ],    
]);