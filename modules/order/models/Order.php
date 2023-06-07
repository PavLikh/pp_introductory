<?php

namespace app\modules\order\models;

use yii\db\ActiveRecord;

/**
 *
 */
class Order extends ActiveRecord
{
    /**
     *
     */
    const DEFAULTPAGESIZE = 100;
    /** @var string $concatName */
    public $concatName;

    /**
     * @return string
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getService()
    {
        return $this->hasOne(Service::class, ['id' => 'service_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatusName()
    {
        return $this->hasOne(Status::class, ['id' => 'status']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModeName()
    {
        return $this->hasOne(Mode::class, ['id' => 'mode']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAll()
    {
        $subquery = Order::find()->select(["orders.*",'concatName' => "CONCAT(first_name, ' ', last_name)"])->from('orders')->leftJoin('users', 'users.id = orders.user_id')->with('user');
        return Order::find()->from(['tb1' =>$subquery ]);
    }
}