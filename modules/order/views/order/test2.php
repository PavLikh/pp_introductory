<? 
use yii\widgets\ActiveForm;
use yii\widgets\ActiveField;
use yii\helpers\Html;

$form = ActiveForm::begin(['options' => ['class' => 'form-inline', 'id' => 'testForm'], 
// 'method' => 'get', 'action'=>['/order/order/test']]);
'method' => 'get', 'action'=>['/order']]);
// $form = ActiveForm::begin(['options' => ['class' => 'form-inline', 'id' => 'testForm', 'action'=>'/order/test'], 'method' => 'get']);
// echo $form->field($model, 'name')->label('Imya');
?>

<div class="input-group">
    <span class="input-group-btn search-select-wrap">
<?
echo $form->field($modelForm, 'search')->textInput(['placeholder' => "Search orders"]);
echo $form->field($modelForm, 'search1')->textInput(['placeholder' => "Search orders"]);
$curSerchType = isset(Yii::$app->request->get()['searchType']) ? Yii::$app->request->get()['searchType'] : '';
echo $form->field($modelForm, 'searchType')->dropdownList( [1 => 'Order ID', 2 => 'Link', 3 =>'Username'],

[
    'options'=>[
        $curSerchType => ['selected' => true]], 
    'class'=> 'form-control search-select'
]// 'name' => 'searchType']
);
echo Html::submitButton('<span class="glyphicon glyphicon-search" aria-hidden="true"></span>', ['class' => 'btn btn-default']);

?>
</span>
</div>
<?
$form = ActiveForm::end();