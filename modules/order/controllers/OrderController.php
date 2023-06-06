<?php

namespace app\modules\order\controllers;

use yii\web\Controller;
use app\modules\order\models\Order;
use app\modules\order\models\Service;
use app\modules\order\models\Mode;
use app\modules\order\models\Status;

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
        $serviceModel = new Service;
        $modeModel = new Mode;
        $statusModel = new Status;

        $services = $serviceModel->getAll();
        $modes = $modeModel->getAll();
        $statuses = $statusModel->getAll();
        
        $orders = $model->prepare()['orders'];
        $pagination = $model->prepare()['pagination'];
        
    return $this->render('index', compact('orders', 'services', 'modes', 'statuses', 'pagination'));
    }
}
