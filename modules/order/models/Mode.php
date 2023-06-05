<?php

namespace app\modules\order\models;

use yii\db\ActiveRecord;

class Mode extends ActiveRecord
{
    /**
     * @inheritdock
     */
    public static function tableName()
    {
        return 'mode';
    }

    /**
     * @inheritdock
     */
    public function getAll()
    {
        return $this::find()->all();

    }
}