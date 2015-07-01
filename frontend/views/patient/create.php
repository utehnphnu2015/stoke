<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Patient */


$this->params['breadcrumbs'][] = ['label' => 'รายการ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patient-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        //'tambon'=>$tambon,
    ]) ?>
</div>
