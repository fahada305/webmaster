<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\advertiser\models\Teasers;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\advertiser\models\CampaignsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Campaigns');
$this->params['breadcrumbs'][] = $this->title;
?>

 

<div class="row">
    <div class="col-xlg-6">

            <!-- display alert flash after saved -->
                <?php if(Yii::$app->session->hasFlash('savedSuccess')): ?>
                    <div class="alert alert-success fade in block-inner" id="success-alert">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <i class="icon-checkmark-circle"></i> <?= Yii::t('app', 'Updated Sucessfully') ?>
                    </div>
                <?php endif; ?>
    
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
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
          //  'user_id',
          //  'section_id',
            'name',
            'price',
            ['attribute'=>'id','label'=>Yii::t('app', 'Ads'),'format' => 'raw','value'=>function($data){
              return  Html::a(Teasers::find()->where(['campaign_id'=>$data->id])->count() .' '. Yii::t('app', 'Ads') ,['teaser','id'=>$data->id]);
            }],
            // 'ban_site:ntext',
            // 'ban_region:ntext',
            // 'ban_country:ntext',
            // 'ban_hour:ntext',
            // 'ban_week_day:ntext',
            // 'dataadd',
             'type',
            // 'OS',
            // 'device',
            // 'status',

            ['class' => 'yii\grid\ActionColumn','template'=>'{create-teaser} {status} {update} {delete}',
                                                
                                                'buttons' => [

                                                'create-teaser' => function ($url,$model,$key) {
                                                   
                                                    return Html::a(
                                                        '<i class="icon-plus" ></i>',$url,['class'=>'btn btn-success btn-icon margin5 tip','data-original-title'=>Yii::t('app', 'Add Teasers')]);
                                                    
                                                },

                                                'status' => function ($url,$model,$key) {

                                                  if($model->status == 3)
                                                  {

                                                  return Html::a('<i class="icon-play" ></i>',['status','id'=>$key,'act'=>2],['class'=>'btn btn-primary btn-icon margin5 tip','data-method'=>'post', 'data-original-title'=>Yii::t('app', 'Start')]);
                                                   
                                                  }
                                                  else
                                                  {

                                                   return Html::a('<i class="icon-pause" ></i>',['status','id'=>$key,'act'=>3],['class'=>'btn btn-danger btn-icon margin5 tip','data-method'=>'post', 'data-original-title'=>Yii::t('app', 'Stop')]);

                                                  }
                                                    
                                                },
                                                
                                            ],
                                            ],
        ],
    ]); ?>

</div>
</div>
</div>
</div>

<script type="text/javascript">
   
   $(document).ready(function(){ 
       // auto hide alert
       $("#success-alert").fadeTo(2000, 500).slideUp(1000, function(){
            $("#success-alert").slideUp(1000);
        });
        // end hide alert 

});
</script>

