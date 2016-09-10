<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Language */
/* @var $form yii\widgets\ActiveForm */


// if file is new then add predefined sytax to it.
if(strlen($file) < 10){

$content = "<?php
/**

Message translations for ".$model['value']. " 

**/

return[

	'' =>'',

]; ";

}else
{
	$content = $file;
}

?>



<script type="text/javascript" src="<?= Yii::getAlias('@web'); ?>/../themes/main/layouts/js/edit_area/edit_area_full.js"></script>

<script type="text/javascript">
	
	editAreaLoader.init({
			id: "example_4"	// id of the textarea to transform		
			//,start_highlight: true	// if start with highlight
			//,font_size: "10"
			,start_highlight: true	// if start with highlight
			,allow_resize: "both"
			,allow_toggle: true
			,word_wrap: true
			,language: "en"
			,syntax: "php"	
			,min_height: 450
		});
</script>



<fieldset>

<div class="well">
	<h6> <?= Yii::t('app', 'Syntax for translation')  ?></h6> 
return [ <br>
'source1'  => 'translation1', <br>
'source2'      => 'translation2',<br>
'source3'      => 'translation3',<br>

  ............................... <br>
  ...............................<br>
  ...............................<br>

];<br>

</div>
<br>

    <?php $form = ActiveForm::begin(); ?>


<textarea id="example_4" style="height: 50px; width: 100%;" name="lang_val"><?=$content?></textarea>
	</fieldset>


	 <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>