<?php

namespace app\modules\order\models;

use Yii;
use yii\db\ActiveRecord;

class Order extends ActiveRecord
{
    public $concatName;
    public static function tableName()
    {
        return 'orders';
    }

    public function getService()
    {
        return $this->hasOne(Service::class, ['id' => 'service_id']);
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function getStatusName()
    {
        return $this->hasOne(Status::class, ['id' => 'status']);
    }

    public function getModeName()
    {
        return $this->hasOne(Mode::class, ['id' => 'mode']);
    }

    public function getAll()
    {
        $subquery = Order::find()->select(["orders.*",'concatName' => "CONCAT(first_name, ' ', last_name)"])->from('orders')->leftJoin('users', 'users.id = orders.user_id')->with('user');
        return Order::find()->from(['tb1' =>$subquery ]);
        // return $this::find();
    }

    public function getByStatus()
    {
        return $this->getAll()->where(['status' => Yii::$app->request->get()['status']]);
    }

    public function getByMode($model)
    // public function getByMode($model)
    {
        return $model->andWhere(['mode' => Yii::$app->request->get()['mode']]);
        // return $this->andWhere(['mode' => Yii::$app->request->get()['mode']]);
        // return $this;
    }

    public function getByService($model)
    {
        return $model->andWhere(['service_id' => Yii::$app->request->get()['service']]);
    }

    public function search()
    {
        $query = $this->getAll();
        $search = Yii::$app->request->get()['search'];
        $searchType = Yii::$app->request->get()['search-type'];
        if ($searchType == '1') {
            $res = $query->where(['id' => $search]);
        } else if ($searchType == '2') {
            $res = $query->where(['like', 'link', $search]);
        } else if ($searchType == '3') {
            $res = $query->where(['like','concatName', $search] );
        }
        return $res;
    }
}