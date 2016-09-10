<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\User;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\SupplierAddressSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Supplier Addresses');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-xlg-6">
    
      <div class="panel panel-primary">
         <div class="panel-heading">
                  <h6 class="panel-title"><i class="icon-home3"></i> <?= Html::encode($this->title) ?></h6>
               
                <div class="pull-right">
                   <?= Html::a('<i class="icon-plus"></i>', ['create'], ['class' => 'btn btn-sm btn-icon btn-success ']) ?>
                       
                   </div>
                   </div>
            <div class="panel-body">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

          //  'Id',
          //  'UserId',
            ['attribute'=>'UserId',
            'filter'=>ArrayHelper::map(User::find()->where(['user_role'=>'supplier'])->andwhere(['status'=>10])->all(),'id',function($data){ return $data->first_name. ' '. $data->last_name; }),

            'value'=>function($data){
               return $data->user['first_name']. ' '. $data->user['last_name']; 
            }

            ],
            'Url:url',
            
             ['attribute'=>'Status',
            'filter'=>['Active' => 'Active','Deactive'=>'Deactive','Pending'=>'Pending'],

           

            ],

            ['class' => 'yii\grid\ActionColumn','template'=>'{update} {delete}'],
        ],
    ]); ?>

</div>
</div>
