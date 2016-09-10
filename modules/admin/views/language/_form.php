<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Language */
/* @var $form yii\widgets\ActiveForm */
?>


    <div class="col-sm-6">  

    <?php $form = ActiveForm::begin(); ?>



    <?= $form->field($model, 'key')->textInput(['maxlength' => true])->hint(Yii::t('app', 'key is directory name, e.g for English key is en, must be ISO 639-1 standards, click '.
    		Html::a('here', 'https://en.wikipedia.org/wiki/List_of_ISO_639-1_codes',['target'=>'_blank']).
    		' for some examples')) ?>

    <?= $form->field($model, 'value')->textInput(['maxlength' => true])->hint(Yii::t('app', 'Name of language, e.g. English , Hindi, Spanish, etc')) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
