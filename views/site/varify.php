
<br clear="all">
<div class="well">	

	<?php if (Yii::$app->session->hasFlash('VarificationComplete')): ?>

    	 <div class="alert alert-success">
       Your Email has been successfully varified.
       Thank you
    </div>
  
<?php endif; ?>


<?php if (Yii::$app->session->hasFlash('InvalidVarification')): ?>

    	 <div class="alert alert-warning">
       Something Went wrong.
       Either Your key is not valid or  already used.
       Contact us for further help.
    </div>

<?php endif; ?>



<?php if (Yii::$app->session->hasFlash('keyExpire')): ?>

    	 <div class="alert alert-warning">
      Your key is expire please generate a new key for to reset your password varification 
    </div>

<?php endif; ?>


<?php if (Yii::$app->session->hasFlash('VarificationNotComplete')): ?>

       <div class="alert alert-warning">
     Something went wrong , your email is not verified, please contact admin for further help.<br/>
     Thank You
    </div>
   
<?php endif; ?>


</div>