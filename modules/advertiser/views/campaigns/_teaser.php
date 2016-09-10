<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\modules\advertiser\models\Teasers */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="teasers-form">

   <?php $form = ActiveForm::begin(['layout'=>'horizontal','options' => ['enctype' => 'multipart/form-data'],
                                    'fieldConfig' => [
                                    'horizontalCssClasses' => [
                                            'label' => 'col-sm-3 text-right',
                                            'wrapper' => 'col-sm-9',
                                            'error' => '',
                                            'hint' => '',
                                        ], ]
                                ]); ?>
    
    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'text')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

  


    <div class="form-group">
        <label class="control-label col-sm-3 text-right" for="teasers-stars">Image</label>
        <div class="col-sm-9">

         <div ng-app="app" ng-controller="Ctrl">
          <div><input type="file" id="fileInput" name="file_input" /></div>
            <div class="croparea_main hide">
                  <div class="cropArea">
                    <img-crop result-image-size="350" image="myImage" result-image="myCroppedImage" area-type="square" ></img-crop>
                  </div>
             
             
                <div class="mythumb"><img ng-src="{{myCroppedImage}}" id="rr"/></div>

                <!-- hidden input to hold value of base64 data of image, 
                it will use in action to create image from from this data -->

                <input type="hidden" name="img" id="cropimg" value="{{myCroppedImage}}">
              
              </div>


            </div>
            
            <img src="" id="gif_img" width="250" class="hide">
       
        </div>

    </div>

   

  

   
    <div class="form-group text-center">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<!-- script for crop image angular.js based ngImgCrop script -->
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular.min.js"></script>
<script src="<?= Yii::getAlias('@web') ?>/cropscript/ng-img-crop.js"></script>
<link rel="stylesheet" type="text/css" href="<?= Yii::getAlias('@web') ?>/cropscript/ng-img-crop.css">
  <style>
    .cropArea {
    background: #E4E4E4;
    overflow: hidden;
    max-width:500px;
    height:350px;
    width: 100%;
    
    }
    .mythumb img{
       max-width: 200px;
       width: 100%; 
    }
  </style>
  <script>
    angular.module('app', ['ngImgCrop'])
      .controller('Ctrl', function($scope) {
        $scope.myImage='';
        $scope.myCroppedImage='';

        var handleFileSelect=function(evt) {
          var file=evt.currentTarget.files[0];
          var reader = new FileReader();
          reader.onload = function (evt) {
            $scope.$apply(function($scope){
              $scope.myImage=evt.target.result;
               $("#cropimg").val(evt.target.result);
            });
          };
          reader.readAsDataURL(file);
         
         
        };

        var getExt = function (e) {
          var fileName = $(this).val();
          var ext = fileName.split('.').pop();

          $(".croparea_main").addClass("hide");
          $('#gif_img').addClass('hide');

          if(ext == 'gif' || ext == 'GIF')
          {
           
           readURL(this);

          }else{

            if(ext == 'jpg' || ext == 'JPG' || ext == 'png' || ext == 'PNG' || ext == 'jpeg' || ext == 'JPEG'){

              $(".croparea_main").removeClass("hide");
            handleFileSelect(e);

          }else{
            alert("please select valid image");
          }
        }

        
        };
        angular.element(document.querySelector('#fileInput')).on('change',getExt);
      });


// flush the blank image from input value 
      $(function() {
          $("#cropimg").val('');
      });



// display normal image if it is gif without cropbox
      function readURL(input) 
      {
  
          if (input.files && input.files[0]) {
              var reader = new FileReader();

              reader.onload = function (e) {
                  $('#gif_img').attr('src', e.target.result);
                  $('#gif_img').removeClass('hide');
              }

              reader.readAsDataURL(input.files[0]);
          }
      }
  </script>
