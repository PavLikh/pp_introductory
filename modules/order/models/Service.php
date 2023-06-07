<?php

namespace app\modules\order\models;

use yii\db\ActiveRecord;

/**
 *
 */
class Service extends ActiveRecord
{
    /**
     * @inheritdock
     */
    public static function tableName()
    {
        return 'services';
    }

    /**
     * @inheritdock
     */
    public function getAll()
    {
        return $this::find()->all();

    }
}