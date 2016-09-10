<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Teasers');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Campaigns'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-xlg-6">

            <!-- display alert flash after saved -->
                <?php if(Yii::$app->session->hasFlash('savedSuccess')): ?>
                    <div class="alert alert-success fade in block-inner" id="success-alert">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <i class="icon-checkmark-circle"></i> <?= Yii::t('app', 'Saved Sucessfully') ?>
                    </div>
                <?php endif; ?>
    
      <div class="panel panel-primary">
         <div class="panel-heading">
                  <h6 class="panel-title"><i class="icon-user"></i> <?= Html::encode($this->title) ?></h6>
               
                <div class="pull-right">
                   <?= Html::a('<i class="icon-plus"></i>', ['create-teaser','id'=>$_GET['id']], ['class' => 'btn btn-sm btn-icon btn-success ']) ?>
                       
                   </div>
                   </div>
            <div class="panel-body">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

          //  'id',
           // 'user_id',
           // 'campaign_id',
           // 'section_id',
           // 'ban_site:ntext',
            // 'ban_region:ntext',
            // 'ban_country:ntext',
            // 'ban_hour:ntext',
            // 'ban_week_day:ntext',
            ['attribute' =>'image', 'format'=>'html', 'value'=>function($data)
            {
               return '<img src="'.Yii::getAlias('@web').'/ads/90/'.$data->image.'" width="90" />' ; 
            }],
            'title',
             'url:url',
             'text',
             'price',
            // 'dataadd',
            // 'dataedit',
            // 'last_show',
            // 'button',
            // 'stars',
            // 'status',

            ['class' => 'yii\grid\ActionColumn','template'=>'{update-teaser} {delete-teaser}',
                                            'buttons' => [
                                                'update-teaser' => function ($url,$model,$key) {
                                                   
                                                    return Html::a(
                                                        '<i class="icon-pencil"></i>',$url,['class'=>'btn btn-success btn-icon margin5 tip','data-original-title'=>Yii::t('app', 'Add Teasers')]);
                                                    
                                                },

                                                 'delete-teaser' => function ($url,$model,$key) {
                                                   
                                                    return Html::a(
                                                        '<i class="icon-remove"></i>',$url,['class'=>'btn btn-danger btn-icon margin5 tip','data-original-title'=>Yii::t('app', 'Add Teasers')]);
                                                    
                                                },
                                                
                                            ],],
        ],
    ]); ?>

</div>
</div>
</div>
</div>
