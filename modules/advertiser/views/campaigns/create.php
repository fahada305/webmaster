<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\advertiser\models\Campaigns */

$this->title = Yii::t('app', 'Create Campaigns');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Campaigns'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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