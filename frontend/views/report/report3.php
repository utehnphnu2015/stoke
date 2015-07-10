<?php
$this->title = 'จำนวนผู้ป่วย Stoke รายอำเภอ';
$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['report/index']];
$this->params['breadcrumbs'][]=$this->title;
//use yii\grid\GridView;
use miloschuman\highcharts\Highcharts;
use yii\helpers\Html;
use kartik\dynagrid\DynaGrid;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;

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


<div id="chart1"></div>

<?php
$sql = "SELECT a.ampurname ,COUNT(p.pid) as total  FROM patient  p
LEFT JOIN campur a on a.ampurcodefull=p.amphur
LEFT JOIN ctambon b on b.tamboncodefull=p.tambon            
GROUP BY a.ampurcodefull";
$rawData = Yii::$app->db->createCommand($sql)->queryAll();
$main_data = [];
foreach ($rawData as $data) {
    $main_data[] = [
        'name' => $data['ampurname'],
        'y' => $data['total'] * 1,
        //'drilldown' => $data['hoscode']
    ];
}
$main = json_encode($main_data);

?>

<?php
$this->registerJs("$(function () {

    $('#chart1').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'จำนวนผู้ป่วย STOKE แยกรายอำเภอ'
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
});", yii\web\View::POS_END);?>

<?php Pjax::begin();?> 
    <?php
    $gridColumns = [
    ['class'=>'kartik\grid\SerialColumn'],
        [
            'label'=>'อำเภอ',
            'attribute'=>'ampurname',
            'pageSummary' => 'รวม ',
            'format' => 'raw',
            'value' => function($model){
                return Html::a(Html::encode($model['ampurname']), [
                            'report/indiv-report3',
                            'ampurcode' => $model['amphur'],
                            
                ]);
            }// end value
        ],
        
        [
            'class' => 'kartik\grid\DataColumn',
            'label'=>'จำนวน',
            'pageSummary' => true,
            'attribute'=>'total'
        ],
       ];           
            echo GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'columns' => $gridColumns,
            'responsive' => true,
            'hover' => true,
            'floatHeader' => FALSE,        
            'showPageSummary' => true,
            'panel' => [           
                'type' => GridView::TYPE_INFO,
                'heading' => 'จำนวนผู้ป่วย STOKE รายปี ตามเพศ ',
                        ],
                    ]);
            ?>
<?php Pjax::end();?>
</div>
