<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>
	
 

        
           
           <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

            
           
                    <div class="col-md-6">
                        <?= $form->field($model, 'first_name')->textInput(['placeholder'=>'First Name']) ?>
                    </div>
               
                    <div class="col-md-6">
                        <?= $form->field($model, 'last_name')->textInput(['placeholder'=>'Last Name']) ?>
                    </div>
             
                     <div class="col-md-6">
                        <?= $form->field($model, 'email')->input('email',['placeholder'=>'Email']) ?>
                     </div>

                      <div class="col-md-6">
                        <?= $form->field($model, 'phone')->input('number',['placeholder'=>'Phone']) ?>
                     </div>
                 
                
                    
                
              
                   <div class="col-md-6">
                     <?= $form->field($model, 'password')->passwordInput(['placeholder'=>'Password'])?> 
                    </div>
               
                     <div class="col-md-6">
                        <?= $form->field($model, 'repeatpassword')->passwordInput(['placeholder'=>'Repeat Password'])->label('Repeat Password')?>
                    </div>
               
                <?php if(Yii::$app->user->can('superadmin')){ ?>

                <div class="col-md-6  <?=$cls?>">
                     <?php $authItems   =   ArrayHelper::map($authItem,'name','name'); ?>
                    <?= $form->field($model, 'user_role')->dropDownList($authItems,['prompt' => 'Select Role', 'class'=>"select-full" ]); ?>
                    </div>

                 <?php } ?>
                 
                     <div class="col-md-6  <?=$cls?>">
                    
                    <?= $form->field($model, 'status')->dropDownList(['10'=>'Active','0'=>'Deactive'],['prompt' => 'Select Status', 'class'=>"select-full" ]); ?>
                    </div>
               
         <br clear="all">

                <div class="form-group" style="margin-right:50px">
                    <div align="center">
                    	<?= Html::submitButton( 'Save', ['class' => 'btn btn-primary']) ?>
                    
                    </div>
                </div>
          
       
    
  <?php ActiveForm::end(); ?>


