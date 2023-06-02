<?php

namespace app\modules\order\models;

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

    public function getAAA()
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
}