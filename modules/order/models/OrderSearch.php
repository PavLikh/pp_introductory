<?php

namespace app\modules\order\models;

use yii\data\ActiveDataProvider;

/**
 *
 */
class OrderSearch extends Order
{
    /**
     * @var
     */
    public $searchType;
    /**
     * @var
     */
    public $search;

    /**
     * @var int[]
     */
    private $searchField = [
        'id' => 1,
        'link' => 2,
        'user' => 3
    ];

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
                'pageSize' => 5,
            ],
        ]);

        if ( $this->load($params) ) {
            if ($this->validate()) {
                if ($this->searchType == $this->searchField['id']) {
                    $query->where(['id' => $this->search]);
                } else if ($this->searchType == $this->searchField['link']) {
                    $query->where(['like','link', $this->search] );
                } else if ($this->searchType == $this->searchField['user']) {
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