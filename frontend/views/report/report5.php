<?php
$this->title = 'จำนวนผู้ป่วย Stroke ตามช่วงอายุ';
$this->params['breadcrumbs'][]=$this->title;
use yii\grid\GridView;
use miloschuman\highcharts\Highcharts;
use yii\helpers\Html;
//use miloschuman\highcharts\Highcharts;
?>
<div style="display: none">
    <?php
    echo Highcharts::widget([
        'scripts' => [
            'highcharts-more', // enables supplementary chart types (gauge, arearange, columnrange, etc.)
            //'modules/exporting', // adds Exporting button/menu to chart
            //'themes/grid',       // applies global 'grid' theme to all charts
            //'highcharts-3d',
            'modules/drilldown'
        ]
    ]);
    ?>
</div>


<div id="chart1"></div>

<?php
$sql = "select year(p.date_addmit) as yy
, sum((year(now())-year(p.birth)) <=31 )as a
, sum((year(now())-year(p.birth)) between 31 and 40  )as b
, sum((year(now())-year(p.birth)) between 41 and 50  )as c
, sum((year(now())-year(p.birth)) between 51 and 60  )as d
, sum((year(now())-year(p.birth)) >61  )as e
from patient p
group by year(p.date_addmit) ";
$rawData = Yii::$app->db->createCommand($sql)->queryAll();
$main_data = [];
foreach ($rawData as $data) {
    $main_data[] = [
        'name' => $data['yy'],
        'data' => ['a','b','c','d','e']
        //'drilldown' => $data['hoscode']
    ];
}
$main = json_encode($main_data);

?>


<?php
$this->registerJs("$(function () {
    $('#container').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Monthly Average Rainfall'
        },
        subtitle: {
            text: 'Source: WorldClimate.com'
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Rainfall (mm)'
            }
        },
        
        series: [{
            name: 'New York',
            data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5, 106.6, 92.3]

        }, {
            name: 'London',
            data: [48.9, 38.8, 39.3, 41.4, 47.0, 48.3, 59.0, 59.6, 52.4, 65.2, 59.3, 51.2]

        }, {
            name: 'Berlin',
            data: [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8, 51.1]

        }]
    });
});", yii\web\View::POS_END);

echo \kartik\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'responsive' => TRUE,
    'hover' => true,
    'floatHeader' => FALSE,
    'panel' => [
        'heading'=>'จำนวนผู้ป่วย Stroke แยกรายปี ตามกลุ่มอายุ',
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