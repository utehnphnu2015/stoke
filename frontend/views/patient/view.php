<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Patient */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'รายชื่อ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patient-view">

    <h2><?= Html::encode($this->title) ?></h2>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->pid], ['class' => 'btn btn-primary']) ?>
        <?php //echo Html::a('Delete', ['delete', 'id' => $model->pid], [
//            'class' => 'btn btn-danger',
//            'data' => [
//                'confirm' => 'Are you sure you want to delete this item?',
//                'method' => 'post',
//            ],
//        ]) ?>
    </p>
    <div class="panel panel-success">
        <div class="panel-heading">ประวัติผู้ป่วย</div>
        <div class="panel-body">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           // 'pid',
            'name',
            'birth',            
            'cid',            
           'address',
            'village',
            [
                'attribute'=>'tambon',
                'value'=>$model->tambons->tambonname,
                'header'=>'ตำบล'
            ],
            [
                'attribute'=>'amphur',
                'value'=>$model->ampurs->ampurname,
                'header'=>'อำเภอ'
            ],
                   ],
              ])
            ?>
        </div>
    </div>
    <div class="panel panel-success">
        <div class="panel-heading">ข้อมูลเข้ารับการรักษาพยาบาล</div>
        <div class="panel-body">
           <?= DetailView::widget([
        'model' => $model,
        'attributes' => [ 
            [
                'attribute'=>'hospcode',
                'value'=>$model->hospcodes->hospname,
                'header'=>'สถานพยาบาล'
            ],
            
            'hn',
            'an',
            'ward',
             'date_addmit',              
            'admit_day',
             [
                'attribute'=>'discharge_type',
                'value'=>$model->discharge->discharge_name,
                'header'=>'ประเภทการจำหน่าย'
            ],
            'pdx',
            
            //'province',
           
            'note1',
            'd_update',
//            'note2',
//            'note3',
//            'note4',
],
              ])
            ?>
        </div>
    </div>
