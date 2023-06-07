<?php

namespace app\modules\order\models;

use yii\db\ActiveRecord;

class Mode extends ActiveRecord
{

    /**
     * @return string
     */
    public static function tableName()
    {
        return 'mode';
    }


    /**
     * @return array|ActiveRecord[]
     */
    public function getAll()
    {
        return $this::find()->all();

    }
}