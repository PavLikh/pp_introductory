<!-- <?php

namespace app\modules\order\models;

use Yii;
use yii\data\Pagination;
use yii\db\ActiveRecord;

class OrderSearch extends Order
{
    public $city;
    public $city;
    public $country;

    // now set the rules to make those attributes safe
    // public function rules()
    // {
    //     public $search;
    //     $search = trim(Yii::$app->request->get()['search']);
    //     $searchType = Yii::$app->request->get()['search-type'];
    //     return [
    //         // ... more stuff here
    //         [['city', 'country'], 'safe'],
    //         // ... more stuff here
    //     ];
    // }
}