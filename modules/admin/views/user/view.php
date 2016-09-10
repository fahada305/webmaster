<?php

use yii\helpers\Html;
use yii\widgets\DetailView;


/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->first_name;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="panel">
		        <div class="panel-heading">
			        <h6 class="panel-title"><i class="icon-paragraph-justify2"></i> <?= Html::encode($this->title) ?></h6>
                	
		        </div>
   
<div class="panel-body">
  <div class="row">
    <div class="col-md-8">
          <table class="table table-bordered">
            <tr>
              <th>Full Name</th><td><?=$model->first_name?></td><th>Email</th><td><?=$model->email?></td>
            </tr>
            
            
             <tr>
              <th>Member Since</th><td><?=date('M d, Y',$model->created_at)?></td><th>Last Updated</th><td><?=date('M d, Y',$model->updated_at)?></td>
            </tr>

           

          </table>
      </div>
    
    </div>
	</div>
</div>
            