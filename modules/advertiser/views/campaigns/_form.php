<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\advertiser\models\Sections;

/* @var $this yii\web\View */
/* @var $model app\modules\advertiser\models\Campaigns */
/* @var $form yii\widgets\ActiveForm */

/* i18n supported array of os */
$os = ['iOS'=>Yii::t('app', 'Apple iOS'),
        'android'=>Yii::t('app', 'Android'),
        'wp'=>Yii::t('app', 'Windows Phone')];

/* i18n supported aray of device **/
$device = ['iphone'=>Yii::t('app', 'Apple Iphone'),
        'ipad'=>Yii::t('app', 'Apple Ipad'),
        'android'=>Yii::t('app', 'Android Device'),
        'wp'=>Yii::t('app', 'Windows Phone Device')];

/* array of countries */

$country = ['AU'=>Yii::t('app', 'Australia'),
            'AT'=>Yii::t('app', 'Austria'),
            'AZ'=>Yii::t('app', 'Azerbaijan')];

/* section array from section model */
$section = ArrayHelper::map(Sections::find()->where(['status'=>1])->all(),'id','name');

/* i18n supported array of days */
$days = ['0'=>Yii::t('app', 'Sunday'),
        '1'=>Yii::t('app', 'Monday'),
        '2'=>Yii::t('app', 'Tuesday'),
        '3'=>Yii::t('app', 'Wednesday'),
        '4'=>Yii::t('app', 'Thursday'),
        '5'=>Yii::t('app', 'Friday'),
        '6'=>Yii::t('app', 'Saturday')];

/** array of hours **/

$hours = [];
for($h=0;$h<24;$h++)
{
    $hours[] = $h; 
}

?>

               

 <?php $form = ActiveForm::begin(['layout'=>'horizontal',
                                    'fieldConfig' => [
                                    'horizontalCssClasses' => [
                                            'label' => 'col-sm-3 text-right',
                                          
                                            'wrapper' => 'col-sm-9',
                                            'error' => '',
                                            'hint' => '',
                                        ],]
                                ]); ?>

        <div class="col-sm-12">
            <?= $form->field($model, 'type')->inline(true)->radioList(['mobile'=>'mobile','desktop'=>'desktop']) ?>
        </div>

        <div class="col-sm-12">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-sm-12">
            <?= $form->field($model, 'OS')->dropDownList($os,['class' => 'select-full', 'multiple'=> true, 'data-placeholder' => 'select os(s)']) ?>
        </div>

        <div class="col-sm-12">
            <?= $form->field($model, 'device')->dropDownList($device,['class' => 'select-full', 'multiple'=> true, 'data-placeholder' => 'select device(s)']) ?>
        </div>

        <div class="col-sm-12">
            <?= $form->field($model, 'section_id')->dropDownList($section,['class' => 'select-full', 'data-placeholder' => 'select section(s)']) ?>
        </div>

        <div class="col-sm-12">
            <?= $form->field($model, 'price')->textInput() ?>
        </div>

         <div class="col-sm-12">
            <?= $form->field($model, 'ban_country')->dropDownList($country,['class' => 'select-full', 'multiple'=> true, 'data-placeholder' => 'select Country(s)']) ?>
        </div>

        <div class="col-sm-12">
            <?= $form->field($model, 'ban_site')->textarea(['class'=>'tags-autocomplete']) ?>
        </div>

       

       

        <div class="col-sm-12">
            <?= $form->field($model, 'ban_hour')->inline(true)->checkBoxList($hours) ?>
        </div>

        <div class="col-sm-12">
            <?= $form->field($model, 'ban_week_day')->inline(true)->checkBoxList($days) ?>
        </div>

      
       

    <div class="form-group text-center">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>


<script type="text/javascript">
   
   $(document).ready(function(){ 

    // apply class to checkbox input
    $('input:checkbox').addClass("styled");
   
});
</script>
<style type="text/css">
    .checkbox-inline{
        margin-left: 0px !important;

        margin-right: 12px;
    }
</style>