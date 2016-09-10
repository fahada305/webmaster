<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

$this->title = 'Contact Member';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">

<div class=" col-md-8">
    <h3><?= Html::encode($this->title) ?></h3>

    <?php if (Yii::$app->session->hasFlash('contactFormSubmitted3')): ?>

    <div class="alert alert-success">
      An Email has been sent to <em style="color:#999"> <?=$user->fullname.' ('.$user->email.') ' ?> </em> . Please wait for reponse. 
    </div>

    

    <?php else: ?>

  
    <div class="row">
        <div class="col-md-12">
            <?php $form = ActiveForm::begin(['id' => 'contact-form2']); ?>
                <div class="row">
                    <div class="col-md-6">
                    <?= $form->field($model, 'name')->textInput(['value'=>$user->fullname , 'readOnly'=>true])->label("Member Name") ?>
                    </div>
                    <div class="col-md-6">
                    <?= $form->field($model, 'email')->textInput(['value'=>$user->email  , 'readOnly'=>true])->label("Member Email") ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                    <label>Your Subject</label>
                    <?= $form->field($model, 'subject')->textInput()->label(false) ?>
                    </div>
                </div>
                <?= $form->field($model, 'body')->textArea(['rows' => 6,'class'=>'editor'])->label("Your Message") ?>
               
                <div class="form-group">
                    <?= Html::submitButton('Send', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

    <?php endif; ?>
</div>
</div>
