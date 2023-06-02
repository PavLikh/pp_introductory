<?php

namespace app\modules\order\controllers;

use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\helpers\Url;

use Yii;
use yii\filters\AccessControl;

use yii\data\Pagination;
use app\modules\order\models\Order;
use app\modules\order\models\Service;
use app\modules\order\models\Mode;
use app\modules\order\models\Status;

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
        // $orders = Order::find()->with('service');
        $services = Service::find()->all();
        $modes = Mode::find()->all();
        $statuses = Status::find()->all();
        // $rows = Test::find()->limit(4)->all();

        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $orders->count()
        ]);

        $orders = $orders->offset( $pagination->offset )->limit( $pagination->limit )->all();
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

    public function actionTest()
    {
        // debug(['actionTest']);
        // echo 'I am actionTest';
        // die();
        // $this->layout = 'qq';
        // echo Url::to(['post/index']);
        return Url::to(['index']);
        // return $this->render('index');
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
