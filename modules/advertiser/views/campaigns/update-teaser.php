<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\advertiser\models\Teasers */

$this->title = Yii::t('app', 'Update Teasers');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Campaigns'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Teasers'), 'url' => ['teaser', 'id' =>$model->campaign_id ] ];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="panel panel-primary">

          <div class="panel-heading">
                        <h6 class="panel-title"><i class="icon-globe"></i> <?=$this->title?></h6>
                       
                      </div>
            <div class="panel-body">

    <?= $this->render('_teaser', [
        'model' => $model,
    ]) ?>

</div>
</div>
