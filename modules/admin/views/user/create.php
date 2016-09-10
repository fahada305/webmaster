<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Add User';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- Panel -->
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
              