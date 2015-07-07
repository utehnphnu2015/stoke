<?php
$this->title = 'จำนวนผู้ป่วย Stoke ตามช่วงอายุ';
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
   
    $('#chart5').highcharts({

        chart: {
            type: 'column'
        },

        title: {
            text: 'Total fruit consumtion, grouped by gender'
        },

        xAxis: {
            categories: ['Apples', 'Oranges', 'Pears', 'Grapes', 'Bananas']
        },

        yAxis: {
            allowDecimals: false,
            min: 0,
            title: {
                text: 'จำนวน'
            }
        },

       

        series: [
        {
            name: '<30ปี',
            colorByPoint: true,
            data:'a'
            
        },
         {
            name: '31-40ปี',
            colorByPoint: true,
            data:'b'
            
        },
         {
            name: '41-50ปี',
            colorByPoint: true,
            data:'c'
            
        },
         {
            name: '51-60ปี',
            colorByPoint: true,
            data:'d'
            
        },
         {
            name: '60>ปีขึ้นไป',
            colorByPoint: true,
            data:'e'
            
        }
        ],
       
    });
});", yii\web\View::POS_END);

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