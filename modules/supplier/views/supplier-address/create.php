<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\SupplierAddress */

$this->title = Yii::t('app', 'Create Supplier Address');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Supplier Addresses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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
</div>
