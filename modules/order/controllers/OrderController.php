<?php

namespace app\modules\order\controllers;

use yii\web\Controller;
use app\modules\order\models\Order;
use app\modules\order\models\Service;
use app\modules\order\models\Mode;
use app\modules\order\models\Status;
use app\modules\order\models\MyForm;
use app\modules\order\models\TestForm;
use app\modules\order\models\SearchForm;
use Yii;
use yii\helpers\Html;

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
        $modelForm = new SearchForm();

        $searchModel = new SearchForm();
        $dataProvider = $searchModel->search1($this->request->queryParams);
        $orders1 = $dataProvider->getModels();
        $pagination1 = $dataProvider->getPagination();
        // var_dump($dataProvider);

        // if ( $modelForm->load(Yii::$app->request->get())) {
        //     var_dump($this->request->queryParams);die();
        //     if ($modelForm->validate() ) {
        //         var_dump(Yii::$app->request->get());
        //         var_dump($modelForm->search);
        //         var_dump($modelForm->search1);
        //         echo 'searchType: '; var_dump($modelForm->searchType);
        //         // var_dump($modelForm->search());
        //         echo 'Hi';
        //         die();
        //     }
        // }

        $model = new Order();
        $serviceModel = new Service();
        $modeModel = new Mode();
        $statusModel = new Status();

// --TEST
// if ($model->load(Yii::$app->request->get()))
// // Yii::$app->request->get();
// {
//     echo 'Hi';
//     die();
// }

// ---END TEST



        $services = $serviceModel->getAll();
        $modes = $modeModel->getAll();
        $statuses = $statusModel->getAll();
        
        $orders = $model->prepare()['orders'];
        $pagination = $model->prepare()['pagination'];
        
    return $this->render('index', compact('pagination1','orders1','dataProvider', 'orders', 'services', 'modes', 'statuses', 'pagination', 'searchModel', 'modelForm'));
    }

    // public function actionForm()
    // {
    //     $form = new MyForm();
    //     if ($form->load(Yii::$app->request->post()) && $form->validate()) {
    //         $name = Html::encode($form->name);
    //         $email = Html::encode($form->email);
    //     }
    //     return $this->render('form', [
    //         'form' => $form,
    //         // 'name' => $name,
    //         // 'email' => $email
    //     ]);
    // }
    public function actionTest()
    {

        // $model = new TestForm();
        $model = new SearchForm();

        // var_dump(Yii::$app->request->get()); die();
        // var_dump($model->load(Yii::$app->request->get()));
        //  die();
        // if ( $model->load(Yii::$app->request->get() && $model->validate())) {
        if ( $model->load(Yii::$app->request->get())) {
            if ($model->validate() ) {
                // var_dump(Yii::$app->request->get());
                var_dump($model->search);
                echo 'Hi';
                die();
            }
        }

        return $this->render('test', compact('model'));
    }

}
