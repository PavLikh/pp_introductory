<? 
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$form = ActiveForm::begin(['options' => ['class' => 'form-inline', 'id' => 'testForm'], 
'method' => 'get', 'action'=>['/order']]);
?>

<div class="input-group">
    <span class="input-group-btn search-select-wrap">
<?
echo $form->field($modelForm, 'search')->textInput(['placeholder' => "Search orders"]);
echo $form->field($modelForm, 'searchType')->dropdownList( $modelForm->getSearchTypes(),
    [
        'options'=>[
            $modelForm->searchType => ['selected' => true]], 
        'class'=> 'form-control search-select'
    ]
);
echo Html::submitButton('<span class="glyphicon glyphicon-search" aria-hidden="true"></span>', ['class' => 'btn btn-default']);

?>
    </span>
</div>
<?
$form = ActiveForm::end();