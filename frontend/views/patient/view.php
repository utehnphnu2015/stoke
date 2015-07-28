<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Patient */

$this->title = 'ชื่อ-สกุล : '.' '.$model->name;
$this->params['breadcrumbs'][] = ['label' => 'รายชื่อ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patient-view">
<div class="alert alert-info" role="alert"><h2><?= Html::encode($this->title) ?></h2></div>
    

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->pid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->pid], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'คุณต้องการ ลบ ข้อมูลนี้?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <div class="panel panel-success">
        <div class="panel-heading">ประวัติผู้ป่วย</div>
        <div class="panel-body">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           // 'pid',
            'name',
            'age',
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
            'date_discharge',
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
