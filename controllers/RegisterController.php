<?php

namespace app\controllers;


use Yii;
use yii\web\Controller;
use app\models\AddUser;
use app\models\User;



class RegisterController extends Controller
{

 public $layout = '@app/themes/main/layouts/login';

  public function beforeAction($action)
    {
         if(!Yii::$app->user->isGuest){

         	 return $this->goHome();

         }



        return parent::beforeAction($action);
    }


	/* register user as customer **/
    public function actionIndex()
    {
        $model = new AddUser();   
        
      //  $model->user_role = 'customer';

        $model->status = 0;

        if ($model->load(Yii::$app->request->post()) ) 
         {

            if($user = $model->adduser()){

                 $link = Yii::$app->urlManager->createAbsoluteUrl(['site/confirm-email','id'=>$user->id,'key'=>$user->auth_key]);
                  
               
                   $email = \Yii::$app->mailer->compose()
                                            ->setTo($user->email)
                                            ->setFrom([\Yii::$app->params['adminEmail'] => \Yii::$app->name . ' robot'])
                                            ->setSubject('Signup Confirmation')
                                            ->setHtmlBody("Click this link to verify your email ".$link)
                                            ->send();



							if($email)
							{
											Yii::$app->getSession()->setFlash('successRegister');
							}
							else
							{
								Yii::$app->getSession()->setFlash('warning');
							}
						
						return $this->refresh();
               
           }
                    
           
        }

        return $this->render('user',[ 'model' => $model,]);
    }



}
