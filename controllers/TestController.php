<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\data\Pagination;
// use yii\web\Response;
// use yii\filters\VerbFilter;
// use app\models\LoginForm;
use app\models\Test;
use app\models\Order;

// use app\models\ContactForm;

class TestController extends Controller
{
    public function actionIndex()
    {
        $rows = Test::find()->all();
        // $rows = Test::find();
        // $orders = Order::find()->limit(20)->all();
        // $orders = Order::find()->limit(20);
        $orders = Order::find();
        // $rows = Test::find()->limit(4)->all();
        // return $this->render('index', [
        //     'rows' => $rows
        // ]);

        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $orders->count()
        ]);

        $orders = $orders->offset( $pagination->offset )->limit( $pagination->limit )->all();
        return $this->render('index', compact('orders', 'rows', 'pagination'));
    }

    public function actionRows()
    {
        $rows = Test::find()->all();
        return $this->render('rows', [
            'rows' => $rows
        ]);
    }

    public function actionRow()
    {
        $row = Test::find()->where(['id' => Yii::$app->request()->get()['id']])->one();
        return $this->render('rows', [
            'row' => $row
        ]);
    }
}