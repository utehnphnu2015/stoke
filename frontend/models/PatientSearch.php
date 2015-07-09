<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Patient;

/**
 * PatientSearch represents the model behind the search form about `frontend\models\Patient`.
 */
class PatientSearch extends Patient
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pid', 'admit_day'], 'integer'],
            [['sex','name', 'birth', 'hn', 'an', 'cid', 'hospcode', 'date_addmit', 'date_discharge', 'ward', 'pdx', 'discharge_type', 'address', 'village', 'tambon', 'amphur', 'province', 'd_update', 'note1', 'note2', 'note3', 'note4'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Patient::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
            'defaultOrder'=>[
            'pid'=> 'SORT_DESC',
                    ]
               ],   
        ]);


        if (isset($_GET['PatientSearch']) && !($this->load($params) && $this->validate())) {
                return $dataProvider;
            }
                    
        $dataProvider->query->joinWith('ampurs');    
        $dataProvider->query->joinWith('tambons');
        $dataProvider->query->joinWith('hospcodes');
        $dataProvider->query->joinWith('discharge');

        $query->andFilterWhere([
            'pid' => $this->pid,
            'birth' => $this->birth,
            'date_addmit' => $this->date_addmit,
            'date_discharge' => $this->date_discharge,
            'admit_day' => $this->admit_day,
            'd_update' => $this->d_update,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'hn', $this->hn])
            ->andFilterWhere(['like', 'sex', $this->sex])    
            ->andFilterWhere(['like', 'an', $this->an])
            ->andFilterWhere(['like', 'cid', $this->cid])
            ->andFilterWhere(['like', 'chospital.hospname', $this->hospcode])
            ->andFilterWhere(['like', 'ward', $this->ward])
            ->andFilterWhere(['like', 'pdx', $this->pdx])
            ->andFilterWhere(['like', 'cdischarce_type.discharge_name', $this->discharge_type])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'village', $this->village])
            ->andFilterWhere(['like', 'ctambon.tambonname', $this->tambon])
            ->andFilterWhere(['like', 'campur.ampurname', $this->amphur])
            ->andFilterWhere(['like', 'province', $this->province])
            ->andFilterWhere(['like', 'note1', $this->note1])
            ->andFilterWhere(['like', 'note2', $this->note2])
            ->andFilterWhere(['like', 'note3', $this->note3])
            ->andFilterWhere(['like', 'note4', $this->note4]);

        return $dataProvider;
    }
}
