<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\advertiser\models\Campaigns */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Campaigns',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Campaigns'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>


<div class="panel panel-primary">

          <div class="panel-heading">
                        <h6 class="panel-title"><i class="icon-globe"></i> <?=$this->title?></h6>
                       
                      </div>
            <div class="panel-body">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>
