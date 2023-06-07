<?php

namespace app\modules\order\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

// class SearchForm extends Model
class SearchForm extends Order
{
    public $searchType;
    public $search;

    private $searchField = [
        'id' => 1,
        'link' => 2,
        'user' => 3
    ];

    public function attributeLabels()
    {
        return [
            'search' => '',
            'searchType' => ''
        ];
    }

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
    public function search1($params)
    {
            $query = $this->getAll();
            // $search = trim(Yii::$app->request->get()['search']);


            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => [
                    'pageSize' => 3,
                ],
            ]);

       

            if ( $this->load($params) ) {
                if ($this->validate()) {
                    // var_dump($this->search);
                    // var_dump($this->searchType);
                    // var_dump($params);die();
                    if ($this->searchType == $this->searchField['id']) {
                // $res = $query->where(['id' => $search]);
                    // $query->andFilterWhere(['like', 'concatName', 'Tess']);
                        $query->where(['id' => $this->search]);
                    } else if ($this->searchType == $this->searchField['link']) {
                // $res = $query->where(['like', 'link', $search]);
                        $query->where(['like','link', $this->search] );
                    } else if ($this->searchType == $this->searchField['user']) {
                        $query->where(['like','concatName', $this->search] );
                    }
                }
            }

            // $query->andFilterWhere(['like', 'concatName', 'Tess']);
        
        return $dataProvider;
        
        
        // $search = $this->search;
        //     // $searchType = Yii::$app->request->get()['search-type'];
        //     $searchType = $this->searchType;
        //     if ($searchType == '1') {
        //         $res = $query->where(['id' => $search]);
        //     } else if ($searchType == '2') {
        //         $res = $query->where(['like', 'link', $search]);
        //     } else if ($searchType == '3') {
        //         $res = $query->where(['like','concatName', $search] );
        //     } else {
        //         $res = false;
        //     }
        // return $res;
    }
}