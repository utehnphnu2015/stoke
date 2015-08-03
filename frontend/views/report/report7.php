<?php
$this->title = 'จำนวนผู้ป่วย STROKE รายปี ตามเพศ';
$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['report/index']];
$this->params['breadcrumbs'][]=$this->title;
//use yii\grid\GridView;
use miloschuman\highcharts\Highcharts;
use yii\helpers\Html;
use kartik\dynagrid\DynaGrid;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;

echo Highcharts::widget([
    'options'=>[        
        'title'=>['text'=>'จำนวนผู้ป่วย STROKE รายปี ตามเพศ'],
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
]);?>

<?php Pjax::begin();?> 
    <?php
    $gridColumns = [
    ['class'=>'kartik\grid\SerialColumn'],
            [
            'label'=>'ปี',
            'attribute'=>'yy',
            'pageSummary' => 'รวม ',
            'headerOptions' => ['class'=>'text-center'],
            'contentOptions' => ['class'=>'text-center'],
        ],
    
    
    
     [
            'class' => 'kartik\grid\DataColumn',
            'label'=>'เพศชาย',
            'attribute'=>'m',
            'pageSummary' => true,
            'vAlign' => 'middle',
            'headerOptions' => ['class'=>'text-center'],    
            'contentOptions' => ['class'=>'text-center'],
        ],
         [
            'label'=>'เพศหญิง',
            'attribute'=>'fe',
            'pageSummary' => true,
            'vAlign' => 'middle',
            'headerOptions' => ['class'=>'text-center'],    
            'contentOptions' => ['class'=>'text-center'],
        ],
        [
            'class' => '\kartik\grid\FormulaColumn',
            'header' => 'รวม(ชาย+หญิง)/ปี',
            'pageSummary' => true,
            'value' => function ($model, $key, $index, $widget) {
                $total = compact('model', 'key', 'index');
                // สูตร เพิ่มคอลัม
                $target =  $widget->col(2, $total);
                $target1 = $widget->col(3, $total);
               
                
                if ($target >= 0) {
                    $amount =$target+$target1;
                    $amount = number_format($amount, 0);
                    return $amount;
                }
            },
            'headerOptions' => ['class'=>'text-center'],
            'contentOptions' => ['class'=>'text-center'],
        ]
           
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
                'heading' => 'จำนวนผู้ป่วย STROKE รายปี ตามเพศ ',
                        ],
                    ]);
            ?>
<?php Pjax::end();?>
</div>
