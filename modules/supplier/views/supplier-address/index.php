<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Supplier Addresses');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-xlg-6">
    
      <div class="panel panel-primary">
         <div class="panel-heading">
                  <h6 class="panel-title"><i class="icon-user"></i> <?= Html::encode($this->title) ?></h6>
               
                <div class="pull-right">
                   <?= Html::a('<i class="icon-plus"></i>', ['create'], ['class' => 'btn btn-sm btn-icon btn-success ']) ?>
                       
                   </div>
            </div>

            <div class="panel-body">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'Id',
            //'UserId',
            'Url:url',
            'Status',

            ['class' => 'yii\grid\ActionColumn','template'=>'{delete}'],
        ],
    ]); ?>

</div>
</div>
</div>
</div>
