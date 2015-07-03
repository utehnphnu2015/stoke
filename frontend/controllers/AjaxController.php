<?php
namespace frontend\controllers;
use Yii;

class AjaxController extends \yii\web\Controller {
    
    public function queryall($sql) {
        return Yii::$app->db->createCommand($sql)->queryAll();
    }   
    public function actionGetTambon($ampur = null) {
        Yii::$app->response->format = "json";
        
        $sql = "SELECT tamboncodefull,tambonname from ctambon  where ampurcode=$ampur";
        $raw = $this->queryall($sql);
        return $raw;      
        
    }    
    public function actionGetIcd101() {
        Yii::$app->response->format = "json";
        
        $sql = "SELECT diagcode from cdisease ";
        $raw = $this->queryall($sql);
        return $raw;      
        
    }  
}
