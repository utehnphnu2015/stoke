<?php
$this->title = 'จำนวนผู้ป่วย STROKE รายปี ตามกลุ่มอายุ';
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
        'title'=>['text'=>'จำนวนผู้ป่วย STROKE รายปี ตามกลุ่มอายุ'],
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
            'label'=>'อายุต่ำว่า<30ปี',
            'attribute'=>'a',
            'pageSummary' => true,
            'headerOptions' => ['class'=>'text-center'],
            'contentOptions' => ['class'=>'text-center'],
        ],
         [
            'class' => 'kartik\grid\DataColumn',
            'pageSummary' => true,
            'label'=>'ระหว่าง31-40ปี',
            'attribute'=>'b',
            'headerOptions' => ['class'=>'text-center'],
            'contentOptions' => ['class'=>'text-center'],
        ],
        [
            'class' => 'kartik\grid\DataColumn',
            'pageSummary' => true,
            'label'=>'ระหว่าง41-50ปี',
            'attribute'=>'c',
            'headerOptions' => ['class'=>'text-center'],
            'contentOptions' => ['class'=>'text-center'],
        ],
         [
            'class' => 'kartik\grid\DataColumn',
            'pageSummary' => true,
            'label'=>'ระหว่าง51-60ปี',
            'attribute'=>'d',
            'headerOptions' => ['class'=>'text-center'],
            'contentOptions' => ['class'=>'text-center'],
        ],
        [
            'class' => 'kartik\grid\DataColumn',
            'pageSummary' => true,
            'label'=>'อายุ60>ปีขึ้นไป',
            'attribute'=>'e',
            'headerOptions' => ['class'=>'text-center'],
            'contentOptions' => ['class'=>'text-center'],
        ],
        [
            'class' => '\kartik\grid\FormulaColumn',
            'header' => 'รวม/ปี',
            'pageSummary' => true,
            'value' => function ($model, $key, $index, $widget) {
                $total = compact('model', 'key', 'index');
                // สูตร เพิ่มคอลัม
                $target =  $widget->col(2, $total);
                $target1 = $widget->col(3, $total);
                $target2 = $widget->col(4, $total);
                $target3 = $widget->col(5, $total);
                $target4 = $widget->col(6, $total);
                
                if ($target >= 0) {
                    $amount =$target+$target1+$target2+$target3+$target4;
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
                'type' => GridView::TYPE_SUCCESS,
                'heading' => 'จำนวนผู้ป่วย STROKE รายปี ตามเพศ ',
                        ],
                    ]);
            ?>
<?php Pjax::end();?>
</div>
