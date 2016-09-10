<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

$this->title 	=Yii::$app->params['site_name'];

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?> | <?=Yii::t('app','Login')?></title>

<link href="<?= Yii::getAlias('@web'); ?>/../themes/main/layouts/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="<?= Yii::getAlias('@web'); ?>/../themes/main/layouts/css/londinium-theme.css" rel="stylesheet" type="text/css">
<link href="<?= Yii::getAlias('@web'); ?>/../themes/main/layouts/css/styles.css" rel="stylesheet" type="text/css">
<link href="<?= Yii::getAlias('@web'); ?>/../themes/main/layouts/css/icons.css" rel="stylesheet" type="text/css">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">

<script type="text/javascript" src="<?= Yii::getAlias('@web'); ?>/../themes/main/layouts/js/libs/jquery/1.10.1/jquery.min.js"></script>
<script type="text/javascript" src="<?= Yii::getAlias('@web'); ?>/../themes/main/layouts/js/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>

<script type="text/javascript" src="<?= Yii::getAlias('@web'); ?>/../themes/main/layouts/js/plugins/charts/sparkline.min.js"></script>

<script type="text/javascript" src="<?= Yii::getAlias('@web'); ?>/../themes/main/layouts/js/plugins/forms/uniform.min.js"></script>
<script type="text/javascript" src="<?= Yii::getAlias('@web'); ?>/../themes/main/layouts/js/plugins/forms/select2.min.js"></script>
<script type="text/javascript" src="<?= Yii::getAlias('@web'); ?>/../themes/main/layouts/js/plugins/forms/inputmask.js"></script>
<script type="text/javascript" src="<?= Yii::getAlias('@web'); ?>/../themes/main/layouts/js/plugins/forms/autosize.js"></script>
<script type="text/javascript" src="<?= Yii::getAlias('@web'); ?>/../themes/main/layouts/js/plugins/forms/inputlimit.min.js"></script>
<script type="text/javascript" src="<?= Yii::getAlias('@web'); ?>/../themes/main/layouts/js/plugins/forms/listbox.js"></script>
<script type="text/javascript" src="<?= Yii::getAlias('@web'); ?>/../themes/main/layouts/js/plugins/forms/multiselect.js"></script>
<script type="text/javascript" src="<?= Yii::getAlias('@web'); ?>/../themes/main/layouts/js/plugins/forms/validate.min.js"></script>
<script type="text/javascript" src="<?= Yii::getAlias('@web'); ?>/../themes/main/layouts/js/plugins/forms/tags.min.js"></script>
<script type="text/javascript" src="<?= Yii::getAlias('@web'); ?>/../themes/main/layouts/js/plugins/forms/switch.min.js"></script>

<script type="text/javascript" src="<?= Yii::getAlias('@web'); ?>/../themes/main/layouts/js/plugins/forms/uploader/plupload.full.min.js"></script>
<script type="text/javascript" src="<?= Yii::getAlias('@web'); ?>/../themes/main/layouts/js/plugins/forms/uploader/plupload.queue.min.js"></script>

<script type="text/javascript" src="<?= Yii::getAlias('@web'); ?>/../themes/main/layouts/js/plugins/forms/wysihtml5/wysihtml5.min.js"></script>
<script type="text/javascript" src="<?= Yii::getAlias('@web'); ?>/../themes/main/layouts/js/plugins/forms/wysihtml5/toolbar.js"></script>

<script type="text/javascript" src="<?= Yii::getAlias('@web'); ?>/../themes/main/layouts/js/plugins/interface/daterangepicker.js"></script>
<script type="text/javascript" src="<?= Yii::getAlias('@web'); ?>/../themes/main/layouts/js/plugins/interface/fancybox.min.js"></script>
<script type="text/javascript" src="<?= Yii::getAlias('@web'); ?>/../themes/main/layouts/js/plugins/interface/moment.js"></script>
<script type="text/javascript" src="<?= Yii::getAlias('@web'); ?>/../themes/main/layouts/js/plugins/interface/jgrowl.min.js"></script>
<script type="text/javascript" src="<?= Yii::getAlias('@web'); ?>/../themes/main/layouts/js/plugins/interface/datatables.min.js"></script>
<script type="text/javascript" src="<?= Yii::getAlias('@web'); ?>/../themes/main/layouts/js/plugins/interface/colorpicker.js"></script>
<script type="text/javascript" src="<?= Yii::getAlias('@web'); ?>/../themes/main/layouts/js/plugins/interface/fullcalendar.min.js"></script>
<script type="text/javascript" src="<?= Yii::getAlias('@web'); ?>/../themes/main/layouts/js/plugins/interface/timepicker.min.js"></script>
<script type="text/javascript" src="<?= Yii::getAlias('@web'); ?>/../themes/main/layouts/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?= Yii::getAlias('@web'); ?>/../themes/main/layouts/js/application.js"></script>
    <?php //$this->head() ?>
</head>

<body class="full-width page-condensed">
<?php $this->beginBody() ?>
	<div class="navbar navbar-inverse" role="navigation">
	<!-- Navbar -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-right">
				<span class="sr-only">Toggle navbar</span>
				<i class="icon-grid3"></i>
			</button>
			<a class="navbar-brand" href="<?= Yii::getAlias('@web'); ?>/"><?=$this->title?></a>
		</div>

		
	</div>
	<!-- /navbar -->
</div>



  



	<!-- Login wrapper -->
	<div class="login-wrapper" style="height:100%;top:40%">
		<?= $content ?>
    	
	</div>  
	<!-- /login wrapper -->
      <br clear="all">      

    
</body>
<?php $this->endBody() ?>

</html>
<?php $this->endPage() ?>
