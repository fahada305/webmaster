<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\ArrayHelper;
use app\modules\admin\models\Language;


/* @var $this \yii\web\View */
/* @var $content string */
$lan = Language::find()->asArray()->all();

$act_lan = Language::find()->asArray()->where(['key'=>Yii::$app->language])->one();

AppAsset::register($this);

$user = Yii::$app->user->identity; 
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">

    <link href="<?= Yii::getAlias('@web'); ?>/../themes/main/layouts/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?= Yii::getAlias('@web'); ?>/../themes/main/layouts/css/londinium-theme.css" rel="stylesheet" type="text/css">
    <link href="<?= Yii::getAlias('@web'); ?>/../themes/main/layouts/css/styles.css" rel="stylesheet" type="text/css">
    <link href="<?= Yii::getAlias('@web'); ?>/../themes/main/layouts/css/icons.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="<?= Yii::getAlias('@web'); ?>/../themes/main/layouts/js/libs/jquery/1.10.1/jquery.min.js"></script>



    <?php //$this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>

	<!-- Navbar -->
	<div class="navbar navbar-inverse" role="navigation">
		<div class="navbar-header">
			<a class="navbar-brand" href="<?= Yii::getAlias('@web'); ?>/admin"><?= Yii::$app->params['site_name']?></a>
			<a class="sidebar-toggle"><i class="icon-paragraph-justify2"></i></a>
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-icons">
				<span class="sr-only">Toggle navbar</span>
				<i class="icon-grid3"></i>
			</button>
			<button type="button" class="navbar-toggle offcanvas">
				<span class="sr-only">Toggle navigation</span>
				<i class="icon-paragraph-justify2"></i>
			</button>
		</div>

		<ul class="nav navbar-nav navbar-right collapse" id="navbar-icons">

		<li class="dropdown mydd1">
            <a  class="dropdown-toggle" data-toggle="dropdown">
           <?php if(\Yii::$app->getRequest()->getCookies()->has('lang')){
              echo $act_lan['value'];
              }else{ echo 'English'; }?>
            </a>
            <ul class="dropdown-menu" role="menu" style="z-index:1800">
            <?php foreach ($lan as $lc => $lv) { ?>
              
              <li>
                <a onclick="getLanguage(this.id);" href="javascript:void(0)" role="menuitem" id="<?=$lv['key']?>"> <?=$lv['value']?></a>
              </li>
              <?php } ?>
            </ul>
          </li>
			
			<li class="user dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown">
					<img src="<?= Yii::getAlias('@web'); ?>/../themes/main/layouts/images/demo/users/face1.png" alt="">
					<span><?=$user->username?></span>
					<i class="caret"></i>
				</a>
				<ul class="dropdown-menu dropdown-menu-right icons-right">
					
					<li><a href="<?= Yii::getAlias('@web'); ?>/site/change-password"><i class="icon-cog"></i> Change password</a></li>
					<li><a href="<?= Yii::getAlias('@web'); ?>/index.php/site/logout" data-method="post"><i class="icon-exit"></i> Logout</a></li>
				</ul>
			</li>
		</ul>
	</div>
	<!-- /navbar -->


	<!-- Page container -->
 	<div class="page-container">

 		<!-- Sidebar -->
		<div class="sidebar">
			<div class="sidebar-content">

				<!-- User dropdown -->
				<div class="user-menu dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<img src="<?= Yii::getAlias('@web'); ?>/../themes/main/layouts/images/demo/users/face1.png" alt="">
						<div class="user-info" style="text-transform:captalize">
							<?=$user->username?> <span><?=$user->user_role;?></span>
						</div>
					</a>
					<div class="popup dropdown-menu dropdown-menu-right">
					    <div class="thumbnail">
					    	<div class="thumb">
								<img alt="" src="<?= Yii::getAlias('@web'); ?>/../themes/main/layouts/images/demo/users/face1.png">
								
						    </div>
					    
					    	<div class="caption text-center">
					    		<h6><?=$user->username?> <small><?=$user->user_role;?></small></h6>
					    	</div>
				    	</div>

				    	
					</div>
				</div>
				<!-- /user dropdown -->


				<!-- Main navigation -->
				<ul class="navigation">
					<li class="active"><a href="<?= Yii::getAlias('@web'); ?>/<?=$user->user_role;?>/"><span>Dashboard</span> <i class="icon-screen2"></i></a></li>

 			<?php 
                
                if($user->user_role == 'admin'){
                
               		include 'admin-menu.php' ; 

                }elseif($user->user_role == 'supplier')
                {
						 include 'supplier-menu.php' ;

				}elseif($user->user_role == 'advertiser')
				{
						 include 'advertiser-menu.php' ;

				}elseif($user->user_role == 'superadmin')
				{
						 include 'superadmin-menu.php' ;
				}
				
			?>
 			
				</ul>
				<!-- /main navigation -->
				
			</div>
		</div>
		<!-- /sidebar -->
 		

		<!-- Page content -->
	 	<div class="page-content">


			<!-- Page header -->
			<br/>
			<!-- /page header -->


			<!-- Breadcrumbs line -->
			<div class="breadcrumb-line">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>

				<div class="visible-xs breadcrumb-toggle">
					<a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
				</div>
			</div>
			<!-- /breadcrumbs line -->



<!-- Default modal -->
			
			<!-- /default modal -->

<div style="min-height: 350px;">
            <?= $content ?>
</div>           
			<!-- Footer -->
	        <div class="footer clearfix" style="margin-top: 50px;">
		        <div class="pull-left">&copy; <?= date('Y'); ?>. Developed & Managed by <a href="http://faystech.com" target="_blank">Fahad</a></div>
	        	<div class="pull-right icons-group">
	        		<a href="#"><i class="icon-screen2"></i></a>
	        		<a href="#"><i class="icon-balance"></i></a>
	        		<a href="#"><i class="icon-cog3"></i></a>
	        	</div>
	        </div>
	        <!-- /footer -->



		</div>
		<!-- /page content -->


	</div>
	<!-- /page container -->
</body>
<?php $this->endBody() ?>
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


 <script type="text/javascript">
    function getLanguage(id) {
     $.post("<?= Yii::getAlias('@web'); ?>/site/language",{'lang':id},function($data) {
       location.reload();
     })
    }
  
  </script>
   

</html>
<?php $this->endPage() ?>