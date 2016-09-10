<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-xlg-6">
    
      <div class="panel panel-primary">
         <div class="panel-heading">
                  <h6 class="panel-title"><i class="icon-user"></i> <?= Html::encode($this->title) ?></h6>
               
                <div class="pull-right">
                   <?= Html::a('<i class="icon-plus"></i>', ['add-user'], ['class' => 'btn btn-sm btn-icon btn-success ']) ?>
                       
                   </div>
                   </div>
            <div class="panel-body myclass1">
       
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'first_name',
            'last_name',
         //   'username',
           // 'auth_key',
            // 'password_hash',
            // 'password_reset_token',
             'email:email',
            // 'phone',
           
            
             ['attribute'=>'user_role',
            'filter'=>['admin'=>'admin','buyer'=>'buyer','seller'=>'seller'],
            'contentOptions'=>['style'=>'width:100px']
             ],
            ['attribute'=>'created_at','label'=>'Last Login','value'=>function($data){            
                  return $data->getLast($data) ;    
                  },
                 
                    'contentOptions'=>['style'=>'width:100px']
                  ],
             [ 'attribute'=>'created_at', 'label'=>'Create Date','contentOptions'=>['style'=>'width:100px'] ,'value'=>function ($data){ return date('M d, Y', $data->created_at); } , ],
            // 'updated_at',

              ['attribute'=>'status','value'=>function($data){            
                  return $data->getStatus($data) ;    
                  },
                  
        'filter'=>['10'=>'Active','0'=>'Deactive'],
                  'contentOptions'=>function ($data){
                                $clr=$data->status==10?'green':'red';
                            return ['style'=>'width:80px;font-weight:bold;color:'.$clr];
                           },
                  ],
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn','template'=>'{view} {update} {status}',

                                         'buttons' => [
                                                'status' => function ($url,$model,$key) {
                                                    if($model->status == 10 && $model->id !=1){
                                                    return Html::a(
                                                        '<span class="icon-arrow-down3" title="Deactive"></span>', Yii::getAlias('@web').'/admin/user/status?val=0&id='.$key,['class'=>'btn btn-sm btn-icon btn-warning btn-round waves-effect waves-light waves-round','data-toggle'=>'tooltip','data-title'=>'Deactivate']);
                                                    }elseif($model->id !=1){

                                                        return Html::a(
                                                        '<span class="icon-arrow-up3" title="Active"></span>', Yii::getAlias('@web').'/admin/user/status?val=10&id='.$key,['class'=>'btn btn-sm btn-icon btn-success btn-round waves-effect waves-light waves-round','data-toggle'=>'tooltip','data-title'=>'Activate']);

                                                    }
                                                },
                                                
                                            ],

                            ],
        
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
</div>
</div>
</div>

<style type="text/css">
    @media(max-width: 480px){
        .myclass1{
            overflow-x: scroll;
        }
    }
</style>