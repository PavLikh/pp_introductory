<?php

namespace app\modules\order\models;

use yii\db\ActiveRecord;

class Mode extends ActiveRecord
{
    public static function tableName()
    {
        return 'mode';
    }
}