<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\widgets\Pjax;
use kartik\dynagrid\DynaGrid;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PatientSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Patients';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patient-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Patient', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin();?> 
    <?php echo \kartik\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel'=>$searchModel,    
    'responsive' => TRUE,
    'hover' => true,
    'floatHeader' => true,
    'panel' => [
        'before' => '',
        'type' => \kartik\grid\GridView::TYPE_SUCCESS,        
    ],
    
    'columns' => [
        ['class'=>'kartik\grid\SerialColumn'],

            //'pid',
            'name',
            //'birth',
            //'hn',
           // 'an',
             'cid',
             'pdx',
             //'date_addmit',
             //'date_discharge',
             //'ward',             
             //'discharge_type',
             //'admit_day',
             'address',
             'village',             
             'tambon',
             'amphur',
              'hospcode',
             //'province',
            // 'd_update',
            // 'note1',
            // 'note2',
            // 'note3',
            // 'note4',
            [
                'class' => 'yii\grid\ActionColumn',
                'options'=>['style'=>'width:120px;'],
                'template'=>'<div class="btn-group btn-group-sm" role="group" aria-label="...">{view}{update}{delete}</div>',
                'buttons'=>[
                    'view'=>function($url,$model,$key){
                        return Html::a('<i class="glyphicon glyphicon-eye-open"></i>',$url,['class'=>'btn btn-default']);
                    }, 
                    'update'=>function($url,$model,$key){
                        return Html::a('<i class="glyphicon glyphicon-pencil"></i>',$url,['class'=>'btn btn-default']);
                    },
                    'delete'=>function($url,$model,$key){
                         return Html::a('<i class="glyphicon glyphicon-trash"></i>', $url,[
                                'title' => Yii::t('yii', 'Delete'),
                                'data-confirm' => Yii::t('yii', 'คุณต้องการลบไฟล์นี้?'),
                                'data-method' => 'post',
                                'data-pjax' => '0',
                                'class'=>'btn btn-default'
                                ]);
                    }
                ]
            ],         
        ]
    
]);
?>  

<?php Pjax::end();?>

</div>
