<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\advertiser\models\CampaignsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="campaigns-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'section_id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'ban_site') ?>

    <?php // echo $form->field($model, 'ban_region') ?>

    <?php // echo $form->field($model, 'ban_country') ?>

    <?php // echo $form->field($model, 'ban_hour') ?>

    <?php // echo $form->field($model, 'ban_week_day') ?>

    <?php // echo $form->field($model, 'dataadd') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'OS') ?>

    <?php // echo $form->field($model, 'device') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
