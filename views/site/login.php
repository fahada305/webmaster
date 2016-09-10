<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="login1">
    
    <?php $form = ActiveForm::begin([
        'id' => 'login-form1',
     
        
    ]); ?>
            <div class="popup-header">
                <a class="pull-left"><i class="icon-lock"></i></a>
                <span class="text-semibold">Login</span>
                <div class="btn-group pull-right">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-cogs"></i></a>
                    <ul class="dropdown-menu icons-right dropdown-menu-right">
                        <li><a href="<?= Yii::getAlias('@web'); ?>/register/index"><i class="icon-star"></i> Register</a></li>
                       
                        <li><a  href="javascript:void(0)" class="forget1" onclick="getForgetForm()"><i class="icon-info"></i> Forgot password?</a></li>
                        
                        
                    </ul>
                </div>
            </div>

            <div class="well" style="padding:30px">
                <?= $form->field($model, 'username')->textInput(['class'=>'form-control']) ?>
             <?= $form->field($model, 'password')->passwordInput(['class'=>'form-control']) ?>

                <div class="row form-actions">
                    <div class="col-xs-6">
                        <div class="checkbox checkbox-success">
                        <label>
                           <?= $form->field($model, 'rememberMe', [
                                'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
                            ])->checkbox() ?>
                        </label>
                        </div>
                    </div>

                    <div class="col-xs-6">
                        <?= Html::submitButton('Login', ['class' => 'btn btn-warning pull-right', 'name' => 'login-button']) ?>
                    </div>
                </div>
            </div>

    <?php ActiveForm::end(); ?>

</div>
    <div class="forgetp hide">
        <form method="post">
        <div class="popup-header">
                <a href="#" class="pull-left"><i class="icon-user-plus"></i></a>
                <span class="text-semibold">Login</span>
                <div class="btn-group pull-right">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-cogs"></i></a>
                    <ul class="dropdown-menu icons-right dropdown-menu-right">
                          <li><a href="<?= Yii::getAlias('@web'); ?>/"><i class="icon-star"></i> Visit Site</a></li>
                        <li><a  href="javascript:void(0)" class="forget1" onclick="getLoginForm()"><i class="icon-info"></i> Go Login</a></li>
                        <li><a href="<?= Yii::getAlias('@web'); ?>/index/contact"><i class="icon-support"></i> Contact admin</a></li>
                        
                    </ul>
                </div>
            </div>

            <div class="well" style="padding:30px">
                <div class="form-group has-feedback">
                    
                <span class="error"></span><br/>
                <div class="material-input input">
                    <label class="control-label" for="loginform-username">Your Email</label>
                    <input type="email" id="email_id" class="form-control"  onkeypress="hideErr()" value="">

              </div>
<br/>
              <input id="submitted" type="button" class="btn btn-info btn-block" onclick="ForgetPassword()" value="Submit" />
           
          </form>
</div>

<style>
.form-horizontal .has-feedback .form-control-feedback {
  top: 22px !important; 
  right: 15px;
}
.error {
    color:red;
    text-align: center;
    font-weight: bold;
}
</style>

<script type="text/javascript">

    function getForgetForm () {
       $(".login1").addClass("hide");
        $(".login1").removeClass("show");

       $(".forgetp").addClass("show");
       $(".forgetp").removeClass("hide");

       $("#myModalLabel").html('<i class="fa fa-lock"></i> FORGET YOUR PASSWORD');
    }

     function getLoginForm () {
       $(".login1").addClass("show");
       $(".login1").removeClass("hide");

       $(".forgetp").addClass("hide");
       $(".forgetp").removeClass("show");

       $("#myModalLabel").html('<i class="fa fa-lock"></i> LOGIN TO YOUR ACCOUNT');
    }
function ForgetPassword() {
    var email = $("#email_id").val();


    if(email.trim() == "") 
    {
            $(".error").css("display","block");
            $(".error").html("Please Input your email first");
    }
    else 
    {

       $.ajax({
          type: "POST",
          url: "<?= Yii::getAlias('@web'); ?>/site/forget?email="+email, 
          
          success: function(data) {
                if(data == 0){
                 $(".error").css("display","block");
                
                $(".error").html("Your email is not exit our database.<br/> please check your email or contact to administrator");
               
              }
              else
              {
                $(".error").css("display","block");
                $(".error").css("color","green");
                $(".error").html("Please check your Email.<br/> We have sent you the instruction to reset your password.");
                 document.getElementById("submitted").disabled=true;
                document.getElementById("submitted").value='Mail Sent';
              }
        }

        });
    }
}

function hideErr () {
  $(".error").css("display","none");
}
jQuery(function(){
jQuery('.close').click(function (){
    location.reload();
});
});

</script>