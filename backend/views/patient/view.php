<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Patient */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Patients', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patient-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->pid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->pid], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'pid',
            'name',
            'birth',
            'hn',
            'an',
            'cid',
            'hospcode',
            'date_addmit',
            'date_discharge',
            'ward',
            'pdx',
            'discharge_type',
            'admit_day',
            'address',
            'village',
            'tambon',
            'amphur',
            'province',
            'd_update',
            'note1',
            'note2',
            'note3',
            'note4',
        ],
    ]) ?>

</div>
