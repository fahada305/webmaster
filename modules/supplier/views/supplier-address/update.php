<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\SupplierAddress */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Supplier Address',
]) . ' ' . $model->Id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Supplier Addresses'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->Id, 'url' => ['view', 'id' => $model->Id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>

<div class="panel panel-primary">
  <div class="panel-heading">
      <h6 class="panel-title"><i class="icon-plus"></i> <?=$this->title?></h6>
                       
  </div>
  <div class="panel-body">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
