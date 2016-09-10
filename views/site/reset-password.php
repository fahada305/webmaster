<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

//$fullname = Yii::$app->user->identity->fullname;

$this->title = 'Reset Your Password ';
$this->params['breadcrumbs'][] = $this->title;


?>
<style>
.error {
    color:red;
    text-align: center;
    font-weight: bold;
}
</style>
<div class="container">

   
  <br clear="all"> 
 
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title"><?=$this->title?></h3>
    </div>
<div class="panel-body">
<div class="row">
	<div class="col-md-12">



		<?php if(Yii::$app->session->hasFlash('passwordChanged')):?>

					<div class="alert alert-success fade in block-inner">
		                <button type="button" class="close" data-dismiss="alert">×</button>
		                <i class="icon-checkmark-circle"></i> Success ! Your Password has been changed.
		            </div>
		        <?php endif; ?>

	</div>
	
</div>
<div class=" col-md-6 " >
    


			<div class="row">

				 <form method="post" class="material">
     		
                <span class="error"></span>
                <div class="form-group input">
                <label class="control-label" for="loginform-username">Your New Password</label>
                    <input class="form-control" type="password" id="password1"  onkeypress="hideErr()" value="">
                 
              </div>
              <div class="form-group input">
              <label class="control-label" for="loginform-username">Repeat New Password</label>
               <input class="form-control" type="password" id="repeatpassword1"  onkeypress="hideErr()" value="">
               
              </div>
			<br/>

			<input id="submitted" type="button" class="btn btn-success" onclick="ResetPassword()" value="Submit" />
             
           </form>

</div>
			</div>		
 </div>  
</div>

		
    




</div>

<script type="text/javascript">
function ResetPassword() {
    var password = $("#password1").val();
    var confirm = $("#repeatpassword1").val();


    if(password.trim() == "" || confirm.trim() == "") 
    {
            $(".error").css("display","block");
            $(".error").html("All fields must be filled");
    }
    else 
    {

	   if(checkPass(password)) 
	    {

	    	if(password == confirm)
	    	{
	    	 $.ajax({
          		type: "POST",
         			url: '<?= Yii::getAlias('@web'); ?>/site/reset?key=<?=$_REQUEST["key"]?>&password='+password, 
          
          			success: function(data) {
               
                $(".error").css("display","block");
                $(".error").css("color","green");
                $(".error").html("Your Password Has been Reset Successfully..");
                 document.getElementById("submitted").disabled=true;
                document.getElementById("submitted").value='Successfull';
                
              
        }

        });
	    	}
	    	else
	    	{
  	 	 		$(".error").css("display","block");
	            $(".error").html("Password must repeat exactly same");
	    	}
	      
  	 }
  	 else{
  	 	 		$(".error").css("display","block");
	            $(".error").html("Password must be atleat 8 charecters, with atleast one lowercase, one uppercase, one digit");
  	 }
    }
}

function hideErr () {
  $(".error").css("display","none");
}

function checkPass(password) {
    var pattern = (/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$/);
    return pattern.test(password);
};
</script>