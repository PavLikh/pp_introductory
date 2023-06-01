<?php

namespace app\modules\order\controllers;

use yii\web\Controller;

use Yii;
use yii\filters\AccessControl;

use yii\data\Pagination;
use app\modules\order\models\Order;
use app\modules\order\models\Service;
use app\modules\order\models\Mode;

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
        // return $this->render('index');
        // $rows = Test::find()->all();
        // $rows = Test::find();
        // $orders = Order::find()->limit(20)->all();
        // $orders = Order::find()->limit(20);
        $orders = Order::find();
        $services = Service::find()->all();
        $modes = Mode::find()->all();
        // $rows = Test::find()->limit(4)->all();
        // return $this->render('index', [
        //     'rows' => $rows
        // ]);

        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $orders->count()
        ]);

        $orders = $orders->offset( $pagination->offset )->limit( $pagination->limit )->all();
        return $this->render('index', compact('orders', 'services', 'modes', 'pagination'));
    }
}
