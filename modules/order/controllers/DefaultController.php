<?php

namespace app\modules\order\controllers;

use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\helpers\Html;

use Yii;
use yii\filters\AccessControl;

use yii\data\Pagination;
use yii\db\Query;
use app\modules\order\models\Order;
use app\modules\order\models\Service;
use app\modules\order\models\Mode;
use app\modules\order\models\Status;
use app\modules\order\models\SearchForm;
use yii\data\ActiveDataProvider;

use function Psy\debug;

/**
 * Default controller for the `ord` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        // $orders = Order::find()->joinWith('user')->limit(10);

        // var_dump($orders->prepare(Yii::$app->db->queryBuilder)->createCommand()->rawSql);
        // exit();
        // $orders = Order::find()->limit(20)->all();
        // $orders = Order::find()->limit(20);
        $info = 'NO STAUS';
        $model = new Order;
        $StatusVal = '---';
        if (isset(Yii::$app->request->get()['status'])){
            $info = 'I have a STATUS';
            // $StatusVal = Yii::$app->request->get()['status'];
            // $orders = Order::find()->where(['status' => Yii::$app->request->get()['status']]);
            $orders = $model->getByStatus();
        } else {
            $orders = $model->getAll();
        }

        if (isset(Yii::$app->request->get()['mode'])) {
            // $orders->andWhere(['mode' => Yii::$app->request->get()['mode']]);
            $orders = $model->getByMode($orders);
            // $orders = $orders->getByMode();
            // $orders = $orders->getByMode($orders);
        }

        if (isset(Yii::$app->request->get()['service'])) {
            // $orders->andWhere(['service_id' => Yii::$app->request->get()['service']]);
            $orders = $model->getByService($orders);
        }

        if (isset(Yii::$app->request->get()['search-type']) && !empty(Yii::$app->request->get()['search'])) {
            // var_dump(isset(Yii::$app->request->get()['search']));
            // $search = Yii::$app->request->get()['search'];
            // $searchType = Yii::$app->request->get()['search-type'];
            // if ($searchType == '1') {
            //     $orders->where(['id' => $search]);
            // } else if ($searchType == '2') {
            //     $orders->where(['like', 'link', $search]);
            // } else if ($searchType == '3') {
            //     // $orders->where(['like','concatName', 'Tess'] );
            //     $orders->where(['like','concatName', $search] );
            // }
            $orders = $model->search();
        }
   
        // $orders = Order::find()->select(["orders.*",'concatName' => "CONCAT(first_name, ' ', last_name)"])->leftJoin('users', 'users.id = orders.user_id')->where(['like', 'users.first_name', 'Tom'])->with('user');
   
   //--- Search
    //    $subquery = Order::find()->select(["orders.*",'concatName' => "CONCAT(first_name, ' ', last_name)"])->from('orders')->leftJoin('users', 'users.id = orders.user_id')->with('user');
        // $orders = Order::find()->from(['tb1' =>$subquery ])->where(['like','concatName', 'Tess'] );
      //  $orders = Order::find()->from(['tb1' =>$subquery ]);
   
   //----End search
   
   
        // var_dump($orders->prepare(Yii::$app->db->queryBuilder)->createCommand()->rawSql);
            // exit();
        // $query = new Query();
        // $orders = $query->select(['orders.id AS id', "CONCAT(first_name, ' ', last_name) AS User", 'link', 'quantity', 'service_id', 'status', 'created_at', 'mode'])->from('orders')->innerJoin('users', 'users.id = orders.user_id')->createCommand()->queryAll( \PDO::FETCH_CLASS);
        $services = Service::find()->all();
        $modes = Mode::find()->all();
        $statuses = Status::find()->all();
        // $rows = Test::find()->limit(4)->all();

        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $orders->count()
        ]);
        $orders = $orders->offset( $pagination->offset )->limit( $pagination->limit )->all();
        // $orders = $orders->offset( $pagination->offset )->limit( $pagination->limit )->createCommand()->queryAll( \PDO::FETCH_CLASS);
        return $this->render('index', compact('orders', 'services', 'modes', 'statuses', 'pagination', 'info', 'StatusVal'));
    }

}
