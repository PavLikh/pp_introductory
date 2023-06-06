<?php

namespace app\modules\order\models;

use yii\db\ActiveRecord;

class Status extends ActiveRecord
{
    /**
     * @inheritdock
     */
    public static function tableName()
    {
        return 'status';
    }

    /**
     * @inheritdock
     */
    public function getAll()
    {
        return $this::find()->all();

    }
}