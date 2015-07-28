<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

//$this->title = 'ลงชื่อเข้าใช้งาน';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>
      
    <div class="alert alert-info" role="alert"><h2>ลงชื่อเข้าใช้งาน</h2>
    
    <p>*ระบุข้อมูลในช่อง Username และ Password ให้ครบถ้วน:</p>

    <div class="row">
        <div class="col-lg-5" >
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                <?= $form->field($model, 'username') ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
                
                <div style="color:#999;margin:1em 0">
                    
                </div>
                <div class="form-group">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
    </div>
    
</div>
