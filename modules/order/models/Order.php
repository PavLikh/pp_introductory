<?php

namespace app\modules\order\models;

use Yii;
use yii\data\Pagination;
use yii\db\ActiveRecord;

class Order extends ActiveRecord
{
    const DEFAULTPAGESIZE = 100;
    /** @var string $concatName */
    public $concatName;
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * Prepare data for view
     *
     * @return array
     */
    public function prepare() {
        if (isset(Yii::$app->request->get()['search-type']) && !empty(Yii::$app->request->get()['search'])) {
            $res = $this->search();
        } else {
            $res = $this->filter();
        }
        return $this->pagination($res);
    }

    /**
     * Search in orders
     *
     * @return object
     */
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

    /**
     * Prepere filtered data
     *
     * @return object
     */
    public function filter() {
        if (isset(Yii::$app->request->get()['status'])){
            $orders = $this->getByStatus();
        } else {
            $orders = $this->getAll();
        }

        if (isset(Yii::$app->request->get()['mode'])) {
            $orders = $this->getByMode($orders);
        }

        if (isset(Yii::$app->request->get()['service'])) {
            $orders = $this->getByService($orders);
        }
        
        return $orders;
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
    }

    public function getByStatus()
    {
        return $this->getAll()->where(['status' => Yii::$app->request->get()['status']]);
    }

    public function getByMode($model)
    {
        return $model->andWhere(['mode' => Yii::$app->request->get()['mode']]);
    }

    public function getByService($model)
    {
        return $model->andWhere(['service_id' => Yii::$app->request->get()['service']]);
    }

    /**
     * Realize pagination
     *
     * @param ArrayObject $orders
     * @return array
     */
    public function pagination($orders) {
        $pagination = new Pagination([
            'defaultPageSize' => $this::DEFAULTPAGESIZE,
            'pageSizeLimit' => [1, 100],
            'totalCount' => $orders->count()
        ]);

        $orders = $orders->offset( $pagination->offset )->limit( $pagination->limit )->all();
        return [
            'pagination' => $pagination,
            'orders' => $orders,
        ];
    }
}