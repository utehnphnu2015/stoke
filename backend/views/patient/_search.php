<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\PatientSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="patient-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pid') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'birth') ?>

    <?= $form->field($model, 'hn') ?>

    <?= $form->field($model, 'an') ?>

    <?php // echo $form->field($model, 'cid') ?>

    <?php // echo $form->field($model, 'hospcode') ?>

    <?php // echo $form->field($model, 'date_addmit') ?>

    <?php // echo $form->field($model, 'date_discharge') ?>

    <?php // echo $form->field($model, 'ward') ?>

    <?php // echo $form->field($model, 'pdx') ?>

    <?php // echo $form->field($model, 'discharge_type') ?>

    <?php // echo $form->field($model, 'admit_day') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'village') ?>

    <?php // echo $form->field($model, 'tambon') ?>

    <?php // echo $form->field($model, 'amphur') ?>

    <?php // echo $form->field($model, 'province') ?>

    <?php // echo $form->field($model, 'd_update') ?>

    <?php // echo $form->field($model, 'note1') ?>

    <?php // echo $form->field($model, 'note2') ?>

    <?php // echo $form->field($model, 'note3') ?>

    <?php // echo $form->field($model, 'note4') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
