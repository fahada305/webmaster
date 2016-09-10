<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */

$this->title = Yii::t('app','Register');
?>



<div class="popup-header">
                <a class="pull-left"><i class="icon-lock"></i></a>
                <span class="text-semibold"><?=$this->title?></span>
                <div class="btn-group pull-right">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-cogs"></i></a>
                    <ul class="dropdown-menu icons-right dropdown-menu-right">
                        <li><a href="<?= Yii::getAlias('@web'); ?>/site/index"><i class="icon-lock"></i> Login</a></li>
                       
                      
                        
                    </ul>
                </div>
            </div>
    
       

 <div class="well">

  <?php if (Yii::$app->session->hasFlash('successRegister')){ ?>

    <br/><br/>
      <div class="alert alert-success success-alert font-size-18">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <strong>Success! </strong>You have successfully registered. <br/>
        You can login after your email varification.<br/>
        Please check your mail for more details.
      </div>
     <br/><br/>
  <?php }else{ ?>

        
           
                <?php $form = ActiveForm::begin(['id' => 'form-signup',]); ?>

            
           
                    <?= $form->field($model, 'first_name')->textInput(['placeholder'=>'First Name']) ?>
                    
               
                    <?= $form->field($model, 'last_name')->textInput(['placeholder'=>'Last Name']) ?>
              
                    <?= $form->field($model, 'email')->input('email',['placeholder'=>'Email']) ?>
                     

                    <?= $form->field($model, 'phone')->input('number',['placeholder'=>'Phone']) ?>
                     
                 
                    <?= $form->field($model, 'password')->passwordInput(['placeholder'=>'Password'])?> 
                    
               
                    <?= $form->field($model, 'repeatpassword')->passwordInput(['placeholder'=>'Repeat Password'])->label('Repeat Password')?>

                     <?= $form->field($model, 'user_role')->dropDownList(['customer'=>'Webmaster','supplier'=>'Advertiser']) ?> 
                   
               
           
           <button type="submit" class="btn btn-primary "><?=$this->title?></button>
          
       
    
  <?php ActiveForm::end(); ?>

  <?php } ?>

  

</div>

