<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\User;

$User = User::find()->where(['user_role'=>'supplier'])->andwhere(['status'=>10])->all();

$Supplier = ArrayHelper::map($User,'id',function($data){ return $data->first_name. ' '. $data->last_name; });

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\SupplierAddress */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="supplier-address-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'UserId')->dropDownList($Supplier,['class'=>'select-full']) ?>

    <?= $form->field($model, 'Url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Status')->dropDownList(['Active' => 'Active','Deactive'=>'Deactive','Pending'=>'Pending'],['prompt'=>'Select One']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
