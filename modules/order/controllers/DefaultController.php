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
        $StatusVal = '---';
        if (isset(Yii::$app->request->get()['status'])){
            $info = 'I have a STATUS';
            $StatusVal = Yii::$app->request->get()['status'];
            $orders = Order::find()->where(['status' => Yii::$app->request->get()['status']]);
        } else {
            $orders = Order::find();
        }

        if (isset(Yii::$app->request->get()['mode'])) {
            $orders->andWhere(['mode' => Yii::$app->request->get()['mode']]);
        }

        if (isset(Yii::$app->request->get()['service'])) {
            $orders->andWhere(['service_id' => Yii::$app->request->get()['service']]);
            // var_dump($orders->prepare(Yii::$app->db->queryBuilder)->createCommand()->rawSql);
            // exit();
        }

        if (isset(Yii::$app->request->get()['search-type'])) {
            $search = Yii::$app->request->get()['search'];
            $searchType = Yii::$app->request->get()['search-type'];
            $searchType = match(Yii::$app->request->get()['search-type'])
            {
                '1' => 'id',
                '2' => 'link',
                '3' => '---username'
            };
            if ($searchType == '1') {
                $orders->where(['id' => $search]);
            } else if ($searchType == '2') {
                $orders->where(['like', 'link', $search]);
            } else {

            }
            // $orders->where(['like', 'link', 'koss']);
            $orders->where(['id' => $search]);
            // var_dump($orders->prepare(Yii::$app->db->queryBuilder)->createCommand()->rawSql);
            // exit();
        }
        // $orders = Order::find()->select(["orders.*",'concatName' => "CONCAT(first_name, ' ', last_name)"])->leftJoin('users', 'users.id = orders.user_id')->where(['like', 'users.first_name', 'Tom'])->with('user');
        $subquery = Order::find()->select(["orders.*",'concatName' => "CONCAT(first_name, ' ', last_name)"])->from('orders')->leftJoin('users', 'users.id = orders.user_id')->with('user');
        $orders = Order::find()->from(['tb1' =>$subquery ])->where(['like','concatName', 'Tess'] );
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


    public function actionPending()
    {
        $orders = Order::find()->where(['status' => 'Pending']);
        $services = Service::find()->all();
        $modes = Mode::find()->all();

        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $orders->count()
        ]);

        $orders = $orders->offset( $pagination->offset )->limit( $pagination->limit )->all();
        return $this->render('index', compact('orders', 'services', 'modes', 'pagination'));
    }

    public function actionStatus()
    {
        $status = Yii::$app->request->get()['status'];
        $orders = Order::find()->where(['status' => $status]);
        $services = Service::find()->all();
        $modes = Mode::find()->all();

        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $orders->count()
        ]);

        $orders = $orders->offset( $pagination->offset )->limit( $pagination->limit )->all();
        return $this->render('index', compact('orders', 'services', 'modes', 'pagination'));
    }

    public function actionOrder()
    {
        return $this->render('index', compact('orders', 'services', 'modes', 'pagination'));
    }

    public function actionGridview()
    {
        // $searchModel = new OrderSeqrch();
        $dataProvider = new ActiveDataProvider([
            'query' => Order::find(),
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'attributes' => ['ID'],
                'defaultOrder' => ['ID' => SORT_ASC]
            ]
        ]);
        return $this->render('gridview', compact('dataProvider'));
    }
        // return $this->render('index');
    public function actionForm()
    {
        $form = new SearchForm;
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            $name = Html::encode($form->name);
            $email = Html::encode($form->email);
        } else {
            $name = '';
            $email = '';
        }
        return $this->render('form',
            [
                'form' => $form,
                'name' => $name,
                'email' => $email
            ]
        );
    }

    // public function behaviors()
    // {
    //     return [
    //         'verbs' => [
    //             'class' => VerbFilter::class,
    //             'action' => [
    //                 'index' => ['get'],
    //                 'create' => ['get'],
    //                 'update' => ['post'],
    //                 'test' => ['get']
    //             ],
    //         ],
    //     ];
    // }
}
