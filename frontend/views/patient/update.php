<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Patient */

$this->title = 'ปรับปรุงข้อมูล : ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'รายชื่อผู้ป่วย', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->pid]];
$this->params['breadcrumbs'][] = 'ปรับปรุงข้อมูล';
?>
<div class="patient-update">
<div class="alert alert-danger" role="alert"><h3><?= Html::encode($this->title) ?></h3></div>
    

    <?= $this->render('_form', [
        'model' => $model,
        'tambon'=>$tambon
    ]) ?>

</div>
