<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\SupplierAddress */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="supplier-address-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'Url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Status')->textInput(['readOnly' => 'readOnly']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
