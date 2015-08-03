<?php

use yii\data\ArrayDataProvider;
use yii\helpers\Html;
use miloschuman\highcharts\Highcharts;

$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['report/index']];
$this->params['breadcrumbs'][] = ['label' => 'จำนวนผู้ป่วยแยกรายอำเภอ', 'url' => ['report/report3']];


if (!count($rawData) > 0) {
    throw new \yii\web\ConflictHttpException("ไม่มีข้อมูล");
}


    ?>
<div style="display: none">
    <?php
    echo Highcharts::widget([
        'scripts' => [
            'highcharts-more', // enables supplementary chart types (gauge, arearange, columnrange, etc.)
            //'modules/exporting', // adds Exporting button/menu to chart
            //'themes/grid',       // applies global 'grid' theme to all charts
            //'highcharts-3d',
            //'modules/drilldown'
        ]
    ]);
    ?>
</div>


<div id="chart2"></div>

<?php
$sql = "SELECT b.tambonname,b.tamboncodefull,p.amphur,COUNT(p.pid) as total  FROM patient  p
            LEFT JOIN campur a on a.ampurcodefull=p.amphur
            LEFT JOIN ctambon b on b.tamboncodefull=p.tambon
            WHERE  p.amphur='$ampurcode'
            GROUP BY b.tamboncodefull
            ORDER BY b.tamboncodefull";
$rawData = Yii::$app->db->createCommand($sql)->queryAll();
$main_data = [];
foreach ($rawData as $data) {
    $main_data[] = [
        'name' => $data['tambonname'],
        'y' => $data['total'] * 1,
        //'drilldown' => $data['hoscode']
    ];
}
$main = json_encode($main_data);

?>

<?php
$this->registerJs("$(function () {

    $('#chart2').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'จำนวนผู้ป่วย STROKE แยกรายตำบล'
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            title: {
                text: '<b>คน</b>'
            },
        },

        legend: {
            enabled: true
        },

        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true
                }
            }
        },

        series: [
        {
            name: 'จำนวน',
            colorByPoint: true,
            data:$main
            
        }
        ],
       
    });
});", yii\web\View::POS_END);

function filter($col) {
    $filterresult = Yii::$app->request->getQueryParam('filterresult', '');
    if (strlen($filterresult) > 0) {
        if (strpos($col['result'], $filterresult) !== false) {
            return true;
        } else {
            return false;
        }
    } else {
        return true;
    }
}

$filteredData = array_filter($rawData, 'filter');
$searchModel = ['result' => Yii::$app->request->getQueryParam('$filterresult', '')];

$dataProvider = new ArrayDataProvider([

    'allModels' => $filteredData,
    'pagination' => false,
    'sort' => [
        'attributes' => count($rawData[0]) > 0 ? array_keys($rawData[0]) : array()
        ]]);


echo \kartik\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,    
    'panel' => ['before' => '',
        'heading'=>'จำนวนผู้ป่วย STROKE แยกรายตำบล',
        ],
    //'floatHeader' => true,
    'columns'=>[
        ['class'=>'yii\grid\SerialColumn'],
//        [
//            'label'=>'ตำบล',
//            'attribute'=>'tambonname'
//        ],
        [
            'label'=>'ตำบล',
            'attribute'=>'tambonname',
            'format' => 'raw',
            'value' => function($model){
                return Html::a(Html::encode($model['tambonname']), [
                            'report/sub-indiv-report3',
                            'tamboncode' => $model['tamboncodefull'],
                            
                ]);
            } //end value
        ],
        [
            'label'=>'จำนวน',
            'attribute'=>'total'
        ],
    ]
]);
?>




