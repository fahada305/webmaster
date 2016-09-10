<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Update : ' . ' ' .$model->first_name.' '.$model->last_name;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->first_name.' '.$model->last_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-primary">
  <div class="panel-heading">
      <h6 class="panel-title"><i class="icon-user"></i> <?=$this->title?></h6>
                       
  </div>
  <div class="panel-body">             
                
    <?= $this->render('_form', [
        'model' => $model,
        'authItem'  =>  $authItem,
         'cls'=>$cls
    ]) ?>

    </div>
         
</div>


          