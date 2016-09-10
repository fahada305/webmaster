<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

$username = Yii::$app->user->identity->username;

$this->title = 'Chnage Password : '.$username;
$this->params['breadcrumbs'][] = $this->title;
?>



		<?php if(Yii::$app->session->hasFlash('passwordChanged')):?>

					<div class="alert alert-success fade in block-inner">
		                <button type="button" class="close" data-dismiss="alert">×</button>
		                <i class="icon-checkmark-circle"></i> Success ! Your Password has been changed.
		            </div>
		        <?php endif; ?>

					<div class="panel panel-default">

		        		<div class="panel-heading">
                                <h6 class="panel-title"><i class="icon-paragraph-justify2"></i> <?=$this->title?></h6>
                                
                            </div>

						<div class="panel-body">

    <?php $form = ActiveForm::begin([ 'layout' => 'horizontal' ]); ?>
      
	  	
       	<?= $form->field($model, 'oldpassword')->passwordInput(['placeholder'=>'Your Old Password'])->label('Old Password') ?>
        
        <?= $form->field($model, 'password')->passwordInput(['placeholder'=>'Your New Password'])->label('New Password') ?>

        <?= $form->field($model, 'repeatpassword')->passwordInput(['placeholder'=>'Repeat New Password'])->label('Repeat Password') ?>

    <div class="form-group">
        <div class="col-md-offset-3 col-md-3">
            <?= Html::submitButton('Change', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
			</div>
				
	</div>