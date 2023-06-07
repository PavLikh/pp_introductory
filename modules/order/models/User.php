<?php

namespace app\modules\order\models;

use yii\db\ActiveRecord;

/**
 *
 */
class User extends ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName()
    {
        return 'users';
    }
}
