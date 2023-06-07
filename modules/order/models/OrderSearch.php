<?php

namespace app\modules\order\models;

use yii\data\ActiveDataProvider;
use Yii;

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
    const SEARCH_ID_TYPE = 1;
    /**
     *
     */
    const SEARCH_LINK_TYPE = 2;
    /**
     *
     */
    const SEARCH_USER_TYPE = 3;
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
                if ($this->searchType == $this::SEARCH_ID_TYPE) {
                    $query->where(['id' => $this->search]);
                } else if ($this->searchType == $this::SEARCH_LINK_TYPE) {
                    $query->where(['like','link', $this->search] );
                } else if ($this->searchType == $this::SEARCH_USER_TYPE) {
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

    /**
     * @return array
     */
    public function getSearchTypes()
    {
        return [
            $this::SEARCH_ID_TYPE => Yii::t('app', 'Order ID'),
            $this::SEARCH_LINK_TYPE => Yii::t('app', 'Link'),
            $this::SEARCH_USER_TYPE => Yii::t('app', 'Username'),
        ];
    }

}