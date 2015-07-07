<?php

use miloschuman\highcharts\Highcharts;
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
        'drilldown' => $data['ampurname']
    ];
}
$main = json_encode($main_data);

$sql = "SELECT a.ampurname , b.tambonname,COUNT(p.pid) as total1  FROM patient  p
LEFT JOIN campur a on a.ampurcodefull=p.amphur
LEFT JOIN ctambon b on b.tamboncodefull=p.tambon            
GROUP BY b.tamboncodefull
";

$rawData = Yii::$app->db->createCommand($sql)->queryAll();
$sub_data = [];
foreach ($rawData as $data) {

    $sub_data[] = [
        'id' => $data['ampurname'],
        'name' => $data['tambonname'],
        'data' => $data['total1'] * 1,
    ];
}
$sub = json_encode($sub_data);
?>


<?php
$this->registerJs("$(function () {

    $('#chart1').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'จำนวนผู้ป่วย STOKE '
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
         drilldown: {
            series:$sub
            
        }
       
    });
});", yii\web\View::POS_END);
?>
<div id="pie"></div>
<?php
$pie_data = [];

$pie_data[] = [
    'name' => 'Chrome',
    'y' => 22
];

$pie_data[] = [
    'name' => 'Firefox',
    'y' => 19,
    'sliced' => true,
    'selected' => true
];


$pie_data[] = [
    'name' => 'IE',
    'y' => 9,
    
   
];


$pie_data[] = [
    'name' => 'Safari',
    'y' => 9,
    
   
];


$pie_data = json_encode($pie_data);


$this->registerJs("$(function () {
    $('#pie').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: 'Browser market shares at a specific website, 2014'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Browser share',
            data: $pie_data
        }]
    });
});
", yii\web\View::POS_END);
?>