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
<!--<div style="display: none">
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
</div>-->


<div id="chart2"></div>

<?php
$sql = "SELECT p.`name` as ptname,p.sex, p.age
            ,CONCAT(p.address,'  หมู่ที่ ' ,p.village) as addpart ,b.tambonname,a.ampurname
            ,year(p.date_addmit)as walkin,b.tamboncodefull,p.amphur  FROM patient  p
             LEFT JOIN campur a on a.ampurcodefull=p.amphur
             LEFT JOIN ctambon b on b.tamboncodefull=p.tambon
             WHERE p.tambon='$tamboncode'
             ORDER BY b.tamboncodefull";
$rawData = Yii::$app->db->createCommand($sql)->queryAll();
$main_data = [];
foreach ($rawData as $data) {
    $main_data[] = [
        'name' => $data['tambonname'],
        //'y' => $data['total'] * 1,
        //'drilldown' => $data['hoscode']
    ];
}
$main = json_encode($main_data);

?>

<?php //
//$this->registerJs("$(function () {
//
//    $('#chart2').highcharts({
//        chart: {
//            type: 'column'
//        },
//        title: {
//            text: 'จำนวนผู้ป่วย STOKE แยกรายตำบล'
//        },
//        xAxis: {
//            type: 'category'
//        },
//        yAxis: {
//            title: {
//                text: '<b>คน</b>'
//            },
//        },
//
//        legend: {
//            enabled: true
//        },
//
//        plotOptions: {
//            series: {
//                borderWidth: 0,
//                dataLabels: {
//                    enabled: true
//                }
//            }
//        },
//
//        series: [
//        {
//            name: 'จำนวน',
//            colorByPoint: true,
//            data:$main
//            
//        }
//        ],
//       
//    });
//});", yii\web\View::POS_END);

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
    'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => '-'],
    'filterModel' => $searchModel,
    'panel' => ['before' => '',
        'heading'=>'รายชื่อผู้ป่วย STROKE ในตำบล',
        ],
    //'floatHeader' => true,
    'columns'=>[
        ['class'=>'yii\grid\SerialColumn'],
        [
            'label'=>'ชื่อ',
            'attribute'=>'ptname'
        ],
        
        [
            'label'=>'เพศ',
            'attribute'=>'sex'
        ],
        [
            'label'=>'อายุ',
            'attribute'=>'age'
        ],
        
        [
            'label'=>'ที่อยู่',
            'attribute'=>'addpart'
        ],
        [
            'label'=>'ตำบล',
            'attribute'=>'tambonname'
        ],
        
        [
            'label'=>'อำเภอ',
            'attribute'=>'ampurname'
        ],
        [
            'label'=>'ปีที่เข้าระบบ',
            'attribute'=>'walkin'
        ],
    ]
]);
?>




