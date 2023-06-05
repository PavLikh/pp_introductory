<?php

namespace app\modules\order\controllers;

use yii\web\Controller;
use Yii;
use yii\data\Pagination;
use yii\db\Query;
use app\modules\order\models\Order;
use app\modules\order\models\Service;
use app\modules\order\models\Mode;
use app\modules\order\models\Status;

use function Psy\debug;

/**
 * Default controller for the `ord` module
 */
class OrderController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $model = new Order;
        if (isset(Yii::$app->request->get()['status'])){
            $info = 'I have a STATUS';
            $orders = $model->getByStatus();
        } else {
            $orders = $model->getAll();
        }

        if (isset(Yii::$app->request->get()['mode'])) {
            $orders = $model->getByMode($orders);
        }

        if (isset(Yii::$app->request->get()['service'])) {
            $orders = $model->getByService($orders);
        }

        if (isset(Yii::$app->request->get()['search-type']) && !empty(Yii::$app->request->get()['search'])) {
            $orders = $model->search();
        }
        
        $services = Service::find()->all();
        $modes = Mode::find()->all();
        $statuses = Status::find()->all();

        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $orders->count()
        ]);
        $orders = $orders->offset( $pagination->offset )->limit( $pagination->limit )->all();
    return $this->render('index', compact('orders', 'services', 'modes', 'statuses', 'pagination'));
    }

}
