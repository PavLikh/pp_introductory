<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
// use yii\bootstrap5\Html;
use yii\helpers\Html;

AppAsset::register($this);
echo __FILE__;
// var_dump(YII_ENV_DEV);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<!-- <html lang="en"> -->
<html lang="<?= Yii::$app->language ?>">
<head>
  <!-- <meta charset="utf-8"> -->
  <meta charset="<?= Yii::$app->charset ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <? $this->registerCsrfMetaTags() ?>
  <title><?= Html::encode($this->title) ?></title>
  <?php $this->head() ?>
  <style>
    .label-default{
      border: 1px solid #ddd;
      background: none;
      color: #333;
      min-width: 30px;
      display: inline-block;
    }
  </style>
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>
<?php $this->beginBody() ?>
<?= $content ?>
<?php  $this->endBody() ?>
</body>
<html>
<?php $this->endPage() ?>