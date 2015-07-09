<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
//use yii\grid\GridView;
?>
<div class="well">
<h3>รายงานผู้ป่วย STOKE </h3>
</div>

<p>
    <?php
    echo \yii\helpers\Html::a('1) จำนวนผู้ป่วยแยกรายอำเภอ ', ['report/report3']);
    
    ?>
</p>

<p>
    <?php
    echo \yii\helpers\Html::a('2) จำนวนผู้ป่วยแยกรายปี(ตามช่วงอายุ) ', ['report/report6']);    
    ?>
</p>
<p>
    <?php
    echo \yii\helpers\Html::a('3) จำนวนผู้ป่วยแยกรายปี(ตามเพศ) ', ['report/report7']);    
    ?>
</p>
<p>
    <?php
    echo \yii\helpers\Html::a('4) แสดงรายชื่อผู้ป่วยแยกรายอำเภอ(ตามช่วงเวลา) ', ['report/report2']);    
    ?>
</p>
<div class="footerrow" style="padding-top: 60px">
   
</div>
