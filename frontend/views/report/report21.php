<?php
$this->title = 'จำนวนผู้ป่วยในแยกรายเดือน';
$this->params['breadcrumbs'][]=$this->title;
use yii\grid\GridView;
use miloschuman\highcharts\Highcharts;
use yii\helpers\Html;

echo GridView::widget([
    'dataProvider'=>$dataProvider,
    'columns'=>[
        ['class'=>'yii\grid\SerialColumn'],
        [
            'label'=>'ปี',
            'attribute'=>'yy'
        ],
        [
            'label'=>'เดือน',
            'attribute'=>'mm'
        ],
        [
            'label'=>'จำนวนผู้ป่วยใน',
            'attribute'=>'cnt'
        ],
    ]
]);

echo Highcharts::widget([
    'options'=>[
        'title'=>['text'=>'จำนวนผู้ป่วยในแยกรายเดือน'],
        'xAxis'=>[
            'categories'=>$mm
        ],
        'yAxis'=>[
            'title'=>['text'=>'จำนวน(คน)']
        ],
        'series'=>[
            [//'type'=>'line',
                'name'=>'จำนวนผู้ป่วยใน',
                'data'=>$cnt,
            ],
            //['name' => 'ผลรวม', 'data' => $sumadj],
            //['name' => 'LOS', 'data' => $los],
        ]
    ]
]);