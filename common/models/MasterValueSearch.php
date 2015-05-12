<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\MasterValue;

/**
 * MasterValueSearch represents the model behind the search form about `common\models\MasterValue`.
 */
class MasterValueSearch extends MasterValue
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['master_value_id', 'order_num'], 'integer'],
            [['locale', 'value_code', 'value', 'description', 'label'], 'safe'],
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
        $query = MasterValue::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'master_value_id' => $this->master_value_id,
            'order_num' => $this->order_num,
        ]);

        $query->andFilterWhere(['like', 'locale', $this->locale])
            ->andFilterWhere(['like', 'value_code', $this->value_code])
            ->andFilterWhere(['like', 'value', $this->value])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'label', $this->label]);

        return $dataProvider;
    }
}
