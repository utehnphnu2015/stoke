<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
//use yii\grid\GridView;
?>
<div class="alert alert-success" role="alert">
    <h3>รายงานผู้ป่วย STOKE </h3><p>
<h5> ข้อมูลการบันทึกผู้ป่วย STOKE ของจังหวัดพิษณุโลก</h5>
</div>
<p>
    <?php
    echo \yii\helpers\Html::a('1) รายชื่อผู้ป่วยแยกตาม อำเภอ (ตามช่วงเวลา) ', ['report/report2']);    
    ?>
</p>
<p>
    <?php
    echo \yii\helpers\Html::a('2) จำนวน/รายชื่อผู้ป่วยแยกตาม อำเภอ ตำบล ', ['report/report3']);
    
    ?>
</p>
<p>
    <?php
    echo \yii\helpers\Html::a('3) จำนวนผู้ป่วยแยกรายปี (ตามช่วงอายุ) ', ['report/report6']);    
    ?>
</p>
<p>
    <?php
    echo \yii\helpers\Html::a('4) จำนวนผู้ป่วยแยกรายปี (ตามเพศ) ', ['report/report7']);    
    ?>
</p>


<div class="footerrow" style="padding-top: 60px">
   
</div>
