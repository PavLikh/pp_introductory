<?php

namespace app\modules\order\models;

use yii\data\ActiveDataProvider;

/**
 *
 */
class OrderSearch extends Order
{
    /**
     *
     */
    const PAGESIZE = 100;
    /**
     *
     */
    const SEARCHFIELD = ['id' => 1, 'link' => 2, 'user' => 3];
    /**
     * @var
     */
    public $searchType;
    /**
     * @var
     */
    public $search;
    /**
     * @return string[]
     */
    public function attributeLabels()
    {
        return [
            'search' => '',
            'searchType' => ''
        ];
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['search', 'searchType'], 'required'],
            [['searchType'], 'number'],
            ['search', 'trim']
        ];
    }

    /**
     * Search in orders
     *
     * @return object
     */
    public function search($params)
    {
        $query = $this->getAll();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => $this::PAGESIZE,
            ],
        ]);

        if ( $this->load($params) ) {
            if ($this->validate()) {
                if ($this->searchType == $this::SEARCHFIELD['id']) {
                    $query->where(['id' => $this->search]);
                } else if ($this->searchType == $this::SEARCHFIELD['link']) {
                    $query->where(['like','link', $this->search] );
                } else if ($this->searchType == $this::SEARCHFIELD['user']) {
                    $query->where(['like','concatName', $this->search] );
                }
            }
        }

        if (isset($params['status'])) {
            $query->where(['status' => $params['status']]);
        }
        if (isset($params['mode'])) {
            $query->andWhere(['mode' => $params['mode']]);
        }
        if (isset($params['service'])) {
            $query->andWhere(['service_id' => $params['service']]);
        }
        return $dataProvider;
    }
}