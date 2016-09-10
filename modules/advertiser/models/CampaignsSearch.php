<?php

namespace app\modules\advertiser\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\advertiser\models\Campaigns;

/**
 * CampaignsSearch represents the model behind the search form about `app\modules\advertiser\models\Campaigns`.
 */
class CampaignsSearch extends Campaigns
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'section_id', 'status'], 'integer'],
            [['name', 'ban_site', 'ban_region', 'ban_country', 'ban_hour', 'ban_week_day', 'dataadd', 'type', 'OS', 'device'], 'safe'],
            [['price'], 'number'],
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
    public function search($params,$cond)
    {
        $query = Campaigns::find()->where($cond);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'section_id' => $this->section_id,
            'price' => $this->price,
            'dataadd' => $this->dataadd,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'ban_site', $this->ban_site])
            ->andFilterWhere(['like', 'ban_region', $this->ban_region])
            ->andFilterWhere(['like', 'ban_country', $this->ban_country])
            ->andFilterWhere(['like', 'ban_hour', $this->ban_hour])
            ->andFilterWhere(['like', 'ban_week_day', $this->ban_week_day])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'OS', $this->OS])
            ->andFilterWhere(['like', 'device', $this->device]);

        return $dataProvider;
    }
}
