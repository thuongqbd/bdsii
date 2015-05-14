<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Product;

/**
 * ProductSearch represents the model behind the search form about `common\models\Product`.
 */
class ProductSearch extends Product
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'product_type', 'product_cate', 'city', 'district', 'ward', 'street', 'project_id', 'price', 'price_type', 'direction', 'balcony_direction', 'floor_number', 'room_number', 'toilet_number', 'ct_phone', 'ct_mobile', 'approved', 'author_id','published', 'deleted', 'created_at', 'updated_at'], 'integer'],
            [['title', 'slug', 'description', 'address', 'interior', 'ct_name', 'ct_address', 'ct_email'], 'safe'],
            [['area', 'facade', 'entry_width'], 'number'],
			 [['start_date','end_date'], 'filter', 'filter'=>'strtotime'],
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
        $query = Product::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'product_id' => $this->product_id,
            'product_type' => $this->product_type,
            'product_cate' => $this->product_cate,
            'city' => $this->city,
            'district' => $this->district,
            'ward' => $this->ward,
            'street' => $this->street,
            'project_id' => $this->project_id,
            'area' => $this->area,
            'price' => $this->price,
            'price_type' => $this->price_type,
            'facade' => $this->facade,
            'entry_width' => $this->entry_width,
            'direction' => $this->direction,
            'balcony_direction' => $this->balcony_direction,
            'floor_number' => $this->floor_number,
            'room_number' => $this->room_number,
            'toilet_number' => $this->toilet_number,
            'ct_phone' => $this->ct_phone,
            'ct_mobile' => $this->ct_mobile,
            'approved' => $this->approved,
            'author_id' => $this->author_id,
            'start_date' => $this->start_date,
//            'end_date' => $this->end_date,
			'published' => $this->published,
            'deleted' => $this->deleted,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'interior', $this->interior])
            ->andFilterWhere(['like', 'ct_name', $this->ct_name])
            ->andFilterWhere(['like', 'ct_address', $this->ct_address])
            ->andFilterWhere(['like', 'ct_email', $this->ct_email]);

        return $dataProvider;
    }
}
