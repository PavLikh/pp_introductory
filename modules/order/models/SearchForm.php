<?php

namespace app\modules\order\models;

use yii\base\Model;

// class SearchForm extends Model
class SearchForm extends Order
{
    public $searchType;
    public $search;
    public $search1;

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
            [['search1', 'searchTyp'], 'safe'],
            [['searchType'], 'number'],
            ['search', 'trim']
        ];
    }

    /**
     * Search in orders
     *
     * @return object
     */
    public function search()
    {
            $query = $this->getAll();
            // $search = trim(Yii::$app->request->get()['search']);
            $search = $this->search;
            // $searchType = Yii::$app->request->get()['search-type'];
            $searchType = $this->searchType;
            if ($searchType == '1') {
                $res = $query->where(['id' => $search]);
            } else if ($searchType == '2') {
                $res = $query->where(['like', 'link', $search]);
            } else if ($searchType == '3') {
                $res = $query->where(['like','concatName', $search] );
            } else {
                $res = false;
            }
        return $res;
    }
}