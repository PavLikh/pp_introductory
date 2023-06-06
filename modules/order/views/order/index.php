<?php

/** @var array $modes */
/** @var array $orders */
/** @var array $services */
/** @var array $statuses */
/** @var object $pagination */

use yii\widgets\LinkPager;
use yii\helpers\Url;
$this->title = Yii::$app->name;

?>
<nav class="navbar navbar-fixed-top navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
    <div class="collapse navbar-collapse" id="bs-navbar-collapse">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Orders</a></li>
      </ul>
    </div>
  </div>
</nav>
<div class="container-fluid">
  <ul class="nav nav-tabs p-b">
    <li class="<?= Url::to() == '/order' ? 'active' : '' ?>"><a href="<?= Url::to(['order/index']); ?>"><?= Yii::t('app', 'All orders') ?></a></li>
    <? foreach($statuses as $status) { ?>
        <li class="
        <?= isset(Yii::$app->request->get()['status']) ? (Yii::$app->request->get()['status'] == $status->id ? 'active' : '') : '' ?>
        ">
        <a href="<?= Url::to(['index', 'status' => $status->id]); ?>"><?= Yii::t('app', $status->name) ?></a></li>
    <? } ?>
    <li class="pull-right custom-search">
      <form class="form-inline" action="/order" method="get">
        <div class="input-group">
          <input type="text" name="search" class="form-control" value="<?= isset(Yii::$app->request->get()['search']) ? Yii::$app->request->get()['search'] : '' ?>" placeholder="Search orders">
          <span class="input-group-btn search-select-wrap">

            <select class="form-control search-select" name="search-type">
              <option value="1" <?= isset(Yii::$app->request->get()['search-type']) ? (Yii::$app->request->get()['search-type'] == 1 ? 'selected=""' : '') : '' ?>>Order ID</option>
              <option value="2" <?= isset(Yii::$app->request->get()['search-type']) ? (Yii::$app->request->get()['search-type'] == 2 ? 'selected=""' : '') : '' ?>>Link</option>
              <option value="3" <?= isset(Yii::$app->request->get()['search-type']) ? (Yii::$app->request->get()['search-type'] == 3 ? 'selected=""' : '') : '' ?>>Username</option>
            </select>
            <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
            </span>
        </div>
      </form>
    </li>
  </ul>

<table class="table order-table">
    <thead>
    <tr>
      <th>ID</th>
      <th><?= Yii::t('app', 'User') ?></th>
      <th><?= Yii::t('app', 'Link') ?></th>
      <th><?= Yii::t('app', 'Quantity') ?></th>
      <th class="dropdown-th">
        <div class="dropdown">
          <button class="btn btn-th btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            <?= Yii::t('app', 'Service') ?>
            <span class="caret"></span>
          </button>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
            <li class="active"><a href="">All (<?= $pagination->totalCount ?>)</a></li>
            <? foreach($services as $service) {?>
              <li><a href="<?= Url::current(['service' => $service->id]) ?>"><span class="label-id"><?= $service->id ?></span> <?= $service->name ?></a></li>
            <? } ?>
          </ul>
        </div>
      </th>
      <th><?= Yii::t('app', 'Status') ?></th>
      <th class="dropdown-th">
        <div class="dropdown">
          <button class="btn btn-th btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            <?= Yii::t('app', 'Mode') ?>
            <span class="caret"></span>
          </button>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
            <li class="active"><a href="">All</a></li>
            <? foreach($modes as $mode) {?>
              <li><a href="<?= Url::current(['mode' => $mode->id]); ?>"><?= $mode->name ?></a></li>  
            <? } ?>
          </ul>
        </div>
      </th>
      <th><?= Yii::t('app', 'Created') ?></th>
    </tr>
    </thead>
    <tbody>

    <? foreach($orders as $order) {?>
      <tr>
      <td><?= $order->id ?></td>
      <td><?= $order->concatName ?></td>
      <td><?= $order->link ?></td>
      <td><?= $order->quantity ?></td>
      <td class="service">
        <span class="label-id"><?= $order->service->id ?></span> <?= $order->service->name ?>
      </td>
      <td><?= Yii::t('app', $order->statusName->name) ?></td>
      <td><?= $order->modeName->name ?></td>
      <td><span class="nowrap"><?= Yii::$app->formatter->asDate( $order->created_at )?></span><span class="nowrap"><?= Yii::$app->formatter->asTime( $order->created_at )?></span></td>
      </tr>
    <? } ?>
    </tbody>
  </table>
  <div class="row">
    <div class="col-sm-8">
      <div class="pagination">
        <?= LinkPager::widget([ 'pagination' => $pagination ])?>
      </div> 
    </div>
    <div class="col-sm-4 pagination-counters">
      <?= $pagination->getPage()+1 ?> to <?= $pagination->getPageCount() ?> of <?= $pagination->totalCount ?>
    </div>
  </div>

</div>
