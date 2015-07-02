<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\widgets\DepDrop;
//use dosamigos\datepicker\DatePicker;
use yii\helpers\Url;
use yii\jui\DatePicker;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use frontend\models\Campur;
use frontend\models\Ctambon;
use frontend\models\Chospital;
use frontend\models\Cdisease;
use frontend\models\Cdischarcetype;

/* @var $this yii\web\View */
/* @var $model frontend\models\Patient */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="patient-form">

    <?php $form = ActiveForm::begin(['id'=>'$model->formName()']); ?>
    <div class="panel panel-primary">
    <div class="panel-heading">
        
            <h4>บันทึกข้อมูลผู้ป่วย STOKE</h4>
        
    </div>
        
        <div class="page-header-line">
            <h3><label class="label label-success">ข้อมูลประวัติผู้ป่วย</label></h3>
        </div>

    <div class="panel-body">
        
        <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-6">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
         <div class="col-xs-4 col-sm-4 col-md-3">            
             <?= $form->field($model, 'cid')->widget(\yii\widgets\MaskedInput::classname(), [
             'mask' => '9-9999-99999-99-9',
                ]) ?>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-3">            
            <?=$form->field($model,'birth')->widget(\yii\jui\DatePicker::classname(),[  
                    'language' => 'th',
                    'dateFormat' => 'yyyy-MM-dd',
                    'clientOptions' => [
                        'changeMonth' => true,
                        'changeYear' => true,
                            ],
                        'options'=>[
                            'class'=>'form-control'
                        ],    
                ]);
            ?>
        </div>    
        </div>
        <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-3">
            <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
        </div> 
        <div class="col-xs-4 col-sm-4 col-md-3">
            <?= $form->field($model, 'village')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-3">           
            <?=
            $form->field($model, 'amphur')->widget(Select2::className(), ['data' => 
                        ArrayHelper::map(Campur::find()->orderBy('ampurname')->all(), 'ampurcodefull', 'ampurname'),
                        'options' => [
                                'id'=>'dlAm',
                                'placeholder' => '<--คลิกเลือกอำเภอ-->'
                            ],                        
                        'pluginOptions' =>
                                [
                            'allowClear' => true
                                ],
                    ]);
            ?>
        </div> 
        <div class="col-md-4">
            <?php
            $list = ArrayHelper::map(Ctambon::find()->where(['amphur'=>$model->ampurcode,'tambon'=>$model->tamboncodefull])->all(),'tamboncodefull','tambonname');
            
            echo $form->field($model, 'tambon')->dropDownList($list, [
                'id' => 'dlTam',
                'prompt' => '--อำเภอ--']
                 );
            ?>
        </div>
</div>
        <hr/> 
        
<div class="page-header-line">
    <h3><label class="label label-danger">ข้อมูลเข้ารับการรักษาพยาบาล</label></h3>
</div>

        <div class="row">
        <div class="col-sm-offset-3 col-sm-6">
            <?=
            $form->field($model, 'hospcode')->widget(Select2::className(), ['data' => 
                        ArrayHelper::map(Chospital::find()->orderBy('hospname')->all(), 'hospcode', 'hospname'),
                        'options' => [                         
                        'placeholder' => '<--คลิกเลือกชื่อสถานพยาบาล-->'],                        
                        'pluginOptions' =>
                        [
                            'allowClear' => true
                        ],
                    ]);
            ?>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-3">
            <?= $form->field($model, 'ward')->textInput(['maxlength' => true]) ?>
        </div>    
        </div> 
        <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-3">
            <?= $form->field($model, 'hn')->textInput(['maxlength' => true]) ?>
        </div>
         <div class="col-xs-4 col-sm-4 col-md-3">
            <?= $form->field($model, 'an')->textInput(['maxlength' => true]) ?>
        </div>
            <div class="col-xs-4 col-sm-4 col-md-3">            
             <?=$form->field($model,'date_addmit')->widget(\yii\jui\DatePicker::classname(),[  
                    'language' => 'th',
                    'dateFormat' => 'yyyy-MM-dd',
                    'clientOptions' => [
                        'changeMonth' => true,
                        'changeYear' => true,
                            ],
                        'options'=>[
                            'class'=>'form-control'
                        ],    
                ]);
            ?>
        </div>
            <div class="col-xs-4 col-sm-4 col-md-3">            
                <?=$form->field($model,'date_discharge')->widget(\yii\jui\DatePicker::classname(),[  
                    'language' => 'th',
                    'dateFormat' => 'yyyy-MM-dd',
                    'clientOptions' => [
                        'changeMonth' => true,
                        'changeYear' => true,
                         ],
                             'options'=>[
                                 'class'=>'form-control'
                        ],
                ]);
            ?>
        </div>
            </div>
                <div class="row">
                    <div class="col-xs-4 col-sm-4 col-md-2">
            <?= $form->field($model, 'admit_day')->textInput() ?>
        </div>
            
            <div class="col-xs-4 col-sm-4 col-md-3">             
            <?=
            $form->field($model, 'discharge_type')->widget(Select2::className(), ['data' => 
                        ArrayHelper::map(Cdischarcetype::find()->orderBy('discharge_id')->all(), 'discharge_id', 'discharge_name'),
                        'options' => [                         
                        'placeholder' => '<--การจำหน่าย-->'],                        
                        'pluginOptions' =>
                        [
                            'allowClear' => true
                        ],
                    ]);
            ?>
        </div>  
            <div class="col-xs-9 col-sm-9 col-md-7">
           <?=
            $form->field($model, 'pdx')->widget(Select2::className(), ['data' => 
                        ArrayHelper::map(Cdisease::find()->orderBy('disease')->all(), 'diagcode', 'diagcode'),
                        'options' => [                         
                        'placeholder' => '<--คลิกเลือกชื่อโรค-->'],                        
                        'pluginOptions' =>
                        [
                            'allowClear' => true
                        ],
                    ]);
            ?>
        </div>
</div>
         
         <div class="row">
        <div class="col-xs-9 col-sm-9 col-md-12">
           <?= $form->field($model, 'note1')->textInput(['maxlength' => true]) ?>
        </div>
        </div>
    <div class="form-group">
            <div class="col-sm-offset-2 col-sm-9">
        <?= Html::submitButton($model->isNewRecord ? 'บันทึก' : 'Update', 
            ['class' => $model->isNewRecord ? 'btn btn-success btn-block' : 'btn btn-primary btn-block']) ?>
    </div>
</div>

    <?php ActiveForm::end(); ?>

        </div>
        </div>
</div>

<?php
$route_get_tambon = \Yii::$app->urlManager->createUrl(['ajax/get-tambon']);

$js = <<<JS
 
   $('#dlAm').on('change', function(){
      
        var param = $(this).val();
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "$route_get_tambon",
            cache: false,
            data: "p="+param,
            success: function(res){            
                $("#dlTam").empty();
                $("#dlTam").append("<option>-- ตำบล --</option>");
                $.each(res,function(index,value){
                    $("#dlTam").append("<option value="+value.tamboncodefull+">" + value.tamboncodefull +"-"+ value.tambonname  + "</option>");                
                });        
            }
        });
        
   });
        
JS;
?>

<?php
$this->registerJs($js);
?>