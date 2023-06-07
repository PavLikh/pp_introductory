<?php

namespace app\modules\order\controllers;

use yii\web\Controller;
use app\modules\order\models\Service;
use app\modules\order\models\Mode;
use app\modules\order\models\OrderSearch;
use app\modules\order\models\Status;
use app\modules\order\models\SearchForm;

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
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $orders = $dataProvider->getModels();
        $pagination = $dataProvider->getPagination();

        $serviceModel = new Service();
        $modeModel = new Mode();
        $statusModel = new Status();

        $services = $serviceModel->getAll();
        $modes = $modeModel->getAll();
        $statuses = $statusModel->getAll();
        
        return $this->render('index', compact('orders', 'services', 'modes', 'statuses', 'pagination', 'searchModel'));
    }
}
