<?php
namespace frontend\controllers;
use Yii;
class AjaxController extends \yii\web\Controller {
    public function queryall($sql) {
        return Yii::$app->db->createCommand($sql)->queryAll();
    }   
    public function actionGetTambon($tam = null) {
        Yii::$app->response->format = "json";
        
        $sql = "SELECT tamboncodefull,tambonname from ctambon  where ampurcode=$am ";
        $raw = $this->queryall($sql);
        return $raw;      
        
    }    
}
