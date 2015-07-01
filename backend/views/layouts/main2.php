<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\widgets\Alert;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
//\backend\assets\MaterialAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <link rel="icon" href="favicon.ico" type="image/x-icon">
        
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>

        <?php $this->beginBody() ?>
        <div class="wrap">
            <ul class="nav navbar-nav">
        <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
        <li><a href="#">Link</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>
      </ul>
    
            <?php
            NavBar::begin([
                'brandLabel' => '<span class="glyphicon glyphicon-th-large"></span>',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-fixed-top navbar-custom',
                ],
            ]);

            if (Yii::$app->user->isGuest) {
                $submenuItems[] = ['label' => 'สมัครผู้ใช้', 'url' => ['/site/signup']];
                $submenuItems[] = ['label' => 'เข้าระบบ', 'url' => ['/site/login']];
            } else {

                //$submenuItems[] = ['label' => 'ตั้งค่า', 'url' => ['/user/index']];

                $submenuItems[] = [
                    'label' => 'ออกจากระบบ',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ];
            }
            
//...............เมนูhosxp-คลินิกเรื้อรัง...............
            
            $report_hosmnu_itms[] = ['label' => '<span class="glyphicon glyphicon-file"></span> HOSxP-CKD', 'url' => ['hosxpckd/index']];
//..........จบ.....เมนูhosxp-คลินิกเรื้อรัง..............
            $report_hosmnu_itms[] = ['label' => '<span class="glyphicon glyphicon-file"></span> HOSxP-DM+CKD', 'url' => ['hosxpckd/ckd']];

            
            
            $report_mnu_itms[] = ['label' => '<span class="glyphicon glyphicon-file"></span> ประชากร', 'url' => ['pop/index']];

            $report_mnu_itms[] = ['label' => '<span class="glyphicon glyphicon-file"></span> การรับบริการ', 'url' => ['opd/index']];

            $report_mnu_itms[] = ['label' => '<span class="glyphicon glyphicon-file"></span> โรคไม่ติดต่อ', 'url' => ['ncd/index']];

            $report_mnu_itms[] = ['label' => '<span class="glyphicon glyphicon-file"></span> ทันตกรรม', 'url' => ['dental/index']];

            $report_mnu_itms[] = ['label' => '<span class="glyphicon glyphicon-file"></span> แม่และเด็ก', 'url' => ['mom/index']];

            $report_mnu_itms[] = ['label' => '<span class="glyphicon glyphicon-file"></span> คัดกรอง', 'url' => ['screen/index']];

            $report_mnu_itms[] = ['label' => '<span class="glyphicon glyphicon-file"></span> โรคติดต่อ', 'url' => ['cd/index']];

            $report_mnu_itms[] = ['label' => '<span class="glyphicon glyphicon-file"></span> ภูมิคุ้มกันโรค', 'url' => ['epi/index']];

            $report_mnu_itms[] = ['label' => '<span class="glyphicon glyphicon-file"></span> แพทย์แผนไทยและแพทย์ทางเลือก', 'url' => ['knott/index']];

            $report_mnu_itms[] = ['label' => '<span class="glyphicon glyphicon-file"></span> สุขภาพจิต', 'url' => ['mind/index']];

            $report_mnu_itms[] = ['label' => '<span class="glyphicon glyphicon-file"></span> ทีมหมอครอบครัว', 'url' => ['kukks/index']];

            //$report_mnu_itms[] = ['label' => '<span class="glyphicon glyphicon-file"></span> Custom-Report', 'url' => ['stimusoft/index']];

            if (!Yii::$app->user->isGuest) {
                $report_mnu_itms[] = ['label' => '<span class="glyphicon glyphicon-refresh"></span> คำสั่ง SQL', 'url' => ['runquery/index']];
            }
            $username = '';
            if (!Yii::$app->user->isGuest) {
                $username = '(' . Html::encode(Yii::$app->user->identity->username) . ')';
            }


            $menuItems = [                    
               
                
                ['label' =>
                    '<span class="glyphicon glyphicon-plus"></span> Hosxp-คลินิกเรื้อรัง',
                    'items' => $report_hosmnu_itms,
                    'visible' => !Yii::$app->user->isGuest
                ],
                
                ['label' => '<span class="glyphicon glyphicon-floppy-open"></span> นำเข้าข้อมูล',
                   'url' => ['/uploadfortythree/index'],
                   'visible' => !Yii::$app->user->isGuest 
                    ],
                ['label' =>
                    '<span class="glyphicon glyphicon-folder-open"></span> ปริมาณข้อมูล',
                    'url' => ['syscountall/index'],
                    'visible' => !Yii::$app->user->isGuest
                ],
                
                ['label' =>
                    '<span class="glyphicon glyphicon-list-alt"></span> รายงาน',
                    'items' => $report_mnu_itms,
                    'visible' => !Yii::$app->user->isGuest
                ],
                
                
                ['label' => '<span class="glyphicon glyphicon-user"></span>  ' . $username,
                    'items' => $submenuItems
                ],
//                ['label' => 'เกี่ยวกับ', 'url' => ['site/about']],
            ];

 
            $config_main = backend\models\Sysconfigmain::find()->one();

            $center = isset($config_main->district_name) ? $config_main->district_name : 'Not set';
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-left'],
                'encodeLabels' => false,
                'items' => [['label' => 'SWLDHDC : ศูนย์ข้อมูล43แฟ้ม อ.' . Html::encode($center)]],
            ]);

            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'encodeLabels' => false,
                'items' => $menuItems,
            ]);

            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'encodeLabels' => false,
            ]);

            NavBar::end();
            ?>

            <div class="container">
                <?php
                $process = \backend\models\SysProcessRunning::find()->one();
                if ($process->is_running === 'true'):
                    $log_time=\frontend\models\SysEventLog::find()->orderBy(['id'=>SORT_DESC])->one();
                    $log_time = isset($log_time->start_at)?$log_time->start_at:'NA';
                ?>
                <div class="alert alert-warning">
                    <i class="glyphicon glyphicon-refresh"></i> เวลา <?=$log_time?> กำลังประมวลผลรายงาน
                    
                </div>
                <?php
                endif;
                ?>
                
                <?=
                Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ])
                ?>
                <?= Alert::widget() ?>
                <?= $content ?>
  
                
            </div>
        </div>

        <footer class="footer">
            <div class="container">
                <p class="pull-left">
                    <?= Html::encode($center) ?> ,

                    <?php
                    $ver = file_get_contents(Yii::getAlias('@version/version.txt'));
                    $ver = explode(',', $ver);
                    ?>
                    เวอร์ชั่น: <?= $ver[0] ?>

                </p>

<!--                <p class="pull-right"><?= Html::a('DHDC TEAM', ['site/about']) ?></p>-->
            </div>
        </footer>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
