<!-- <div class="ord-default-index">
    <h1><?= $this->context->action->uniqueId ?></h1>
    <p>
        This is the view content for action "<?= $this->context->action->id ?>".
        The action belongs to the controller "<?= get_class($this->context) ?>"
        in the "<?= $this->context->module->id ?>" module.
    </p>
    <p>
        You may customize this page by editing the following file:<br>
        <code><?= __FILE__ ?></code>
    </p>
</div> -->

<?php
use yii\widgets\LinkPager;
use yii\helpers\Url;
$this->title = Yii::$app->name;
// var_dump($orders->asd);
// die();
?>
<br>
<?= $info?>
<?= $StatusVal?>
<br>
<? $url = Url::current(['aaa'=>'ffff']); ?>
<?// $url1 = Url::to(['index', 'status' => 'Pending']); ?>
<a href="<?= $url ?>"><?= $url ?></a>
<!-- <a href="<?//= $url1 ?>"><?//= $url1 ?></a> -->
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
    <li class="active"><a href="<?= Url::to(['index']); ?>">All orders</a></li>
    <? foreach($statuses as $status) { ?>
        <li><a href="<?= Url::to(['index', 'status' => $status->id]); ?>"><?= $status->name ?></a></li>
    <? } ?>
    <li class="pull-right custom-search">
      <form class="form-inline" action="/order/default" method="get">
        <div class="input-group">
          <input type="text" name="search" class="form-control" value="" placeholder="Search orders">
          <span class="input-group-btn search-select-wrap">

            <select class="form-control search-select" name="search-type">
              <option value="1" selected="">Order ID</option>
              <option value="2">Link</option>
              <option value="3">Username</option>
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
      <th>User</th>
      <th>Link</th>
      <th>Quantity</th>
      <th class="dropdown-th">
        <div class="dropdown">
          <button class="btn btn-th btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            Service
            <span class="caret"></span>
          </button>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
            <li class="active"><a href="">All (894931)</a></li>
            <? foreach($services as $service) {?>
              <li><a href="<?= Url::current(['service' => $service->id]); ?>"><span class="label-id"><?= $service->id ?></span> <?= $service->name ?></a></li>
            <? } ?>
          </ul>
        </div>
      </th>
      <th>Status</th>
      <th class="dropdown-th">
        <div class="dropdown">
          <button class="btn btn-th btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            Mode
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
      <th>Created</th>
    </tr>
    </thead>
    <tbody>

  <!-- 
  `created_at` int NOT NULL,
  `mode` tinyint(1) NOT NULL COMMENT '0 - Manual, 1 - Auto' -->
    <? foreach($orders as $order) {?>
      <?//var_dump($order->concatName);
      // die();
      ?>
      <tr>
      <td><?= $order->id ?></td>
      <!-- <td>waliullah</td> -->
      <!-- <td><?//= $order->user->first_name ?></td> -->
      <td><?= $order->concatName ?></td>
      <!-- <td class="link">/p/BMRSv4FDevy/</td> -->
      <td><?= $order->link ?></td>
      <!-- <td>3000</td> -->
      <td><?= $order->quantity ?></td>
      <td class="service">
        <span class="label-id"><?= $order->service->id ?></span> <?= $order->service->name ?>
      </td>
      <td><?= $order->statusName->name ?></td>
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
