<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\LoginLog;
use app\modules\admin\models\Product;
use app\modules\admin\models\Category; 
use app\models\AddUser;
use app\models\AuthItem;
use app\models\User;

class SiteController extends Controller
{
   
   public $layout = '@app/themes/main/layouts/login';
    public $enableCsrfValidation = false;

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout','change-password',],
                'rules' => [
                    [
                        'actions' => ['logout','change-password'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }


    public function actionIndex()
    {   
        if(!Yii::$app->user->isGuest)
        {
         $roles = Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());

            foreach($roles as $role)
            {
                
                $path = $role->name;

                if($path)
                {

                 return $this->redirect($path);

                }
            
            }
          }else{
            return $this->redirect(['login']);
          }
    }

   

    public function actionLogin()
    {
        if(!Yii::$app->user->isGuest)
        {
           return $this->goHome();
        }
        else
        {

          return $this->redirect('signin');

        }   
        
    }

     public function actionSignin()
    {
        if(!Yii::$app->user->isGuest)
        {
           return $this->goHome();
        }
    
       $this->layout = '@app/themes/main/layouts/login';
            
        $model = new LoginForm(['scenario' => 'login']);

        if (Yii::$app->request->isAjax && $model->load($_POST))
        {
            Yii::$app->response->format = 'json';
            return \yii\bootstrap\ActiveForm::validate($model);
         }

        if ($model->load(Yii::$app->request->post()) && $model->login()) {

           
            $login_log = LoginLog::find()->where(['UserId'=>Yii::$app->user->identity->id])->one();
            if($login_log){
                $log = $login_log;
            }else{
               $log    =   new LoginLog();  
            }
            $log->UserId    =   Yii::$app->user->getId();
            $log->LoginAt  =   date('Y-m-d H:i:s');
            $log->LoginIp   =   $_SERVER['REMOTE_ADDR'];
            $log->save();

            $session = Yii::$app->session;
            $session->set('LogId', $log->LogId);

            return $this->goHome();
            
            
            
        } 
            return $this->render('login', [
                'model' => $model,
            ]);
        
    }

    public function actionLogout()
    {
        $session = Yii::$app->session;
            $id     =   $session->get('LogId');
            if ($session->has('LogId')){
                    $log    =   LoginLog::findOne($id);
                    
                    $log->LogoutAt  =   date('Y-m-d H:i:s');
                    $log->save();
                }
                

            Yii::$app->user->logout();

            $session->remove('LogId');

             return $this->goHome();
    }

    public function actionContact()
    {

      
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

   


  


     public function actionLanguage()
    {
        if(isset($_POST['lang'])){
            Yii::$app->language = $_POST['lang'];

           $cookie = new \yii\web\Cookie([
                        'name' => 'lang',
                        'value' => $_POST['lang']
                        ]);

              Yii::$app->getResponse()->getCookies()->add($cookie);
        }
    }



     


/** function for email verification after user registration **/
  public function actionConfirmEmail($id, $key)
    {
                $user = User::find()->where(['id'=>$id,'auth_key'=>$key,'status'=>0])->one();

                $admin_user = User::find()
                                    ->where(['user_role'=>'admin'])
                                    ->orwhere(['user_role'=>'superadmin'])
                                    ->andwhere(['status'=>10])
                                    ->asArray()->all();


                $html_msg  = "<p>Signup process completed by one user, he also confirmed his email</p>";
                $html_msg .= "<p>The details are given below:</p>";

                $html_msg .= "<p>UserName : ".$user->username." </p>";
                $html_msg .= "<p>Email : ".   $user->email   ." </p>";
                $html_msg .= "<p>First Name : ".$user->first_name." </p>";
                $html_msg .= "<p>Last Name : ".$user->last_name." </p>";
                $html_msg .= "<p>Phone  : ".$user->phone." </p>";
                $html_msg .= "<p>User Role  : ".$user->user_role." </p>";
                $html_msg .= "<p>Registration Date : ".date('M d, Y', $user->created_at)." </p>";
                $html_msg .= "<p>Verification Date : ".date('M d, Y', $user->updated_at)." </p>";

                $link      = \Yii::$app->urlManager->createAbsoluteUrl(['site/login']);

                $html_msg .= "<p><a href='".$link."'>Click here</a> To login </p>";





                if(!empty($user))
                {
                   //$user->status=10;
                    $user->updated_at = time();
                    $user->save();

                    Yii::$app->getSession()->setFlash('success','Success!');

                     
                     $email = \Yii::$app->mailer->compose()
                                            ->setTo(array_column($admin_user,'email'))
                                            ->setFrom([\Yii::$app->params['adminEmail'] => \Yii::$app->name . ' robot'])
                                            ->setSubject('Signup Confirmation Completed ')
                                            ->setHtmlBody($html_msg)
                                            ->send();

                     

                     Yii::$app->user->login($user);

                     Yii::$app->session->setFlash('VarificationComplete');
                    return $this->render('varify');


                }

                else
                {

               Yii::$app->session->setFlash('VarificationNotComplete');
                return $this->render('varify');
                 
                
                }

                return $this->goHome();
               
    }


    /********************------Change Paasword-------**********************/
    
    public function actionChangePassword()
    {   
        
        $this->layout = '@app/themes/main/layouts/main';

         $userId     =   Yii::$app->user->identity->id;
         $model = User::find()->where(['id'=>$userId])->one();
         $model->scenario = 'changeP';
            
       
         if ($model->load(Yii::$app->request->post())) {
             
             $oldpassword   =   $model->oldpassword;
             $password      =   $model->password;
            
            $hash           =   $model->password_hash;

             $result        =   Yii::$app->getSecurity()->validatePassword($oldpassword, $hash);
            
             $NewPassword   =   Yii::$app->getSecurity()->generatePasswordHash($password);
                
                if($result)
                {
                    
                    $model->password_hash  =   $NewPassword;
                    $confirm                        =   $model->save();
                    if($confirm)
                    {
                                 Yii::$app->session->setFlash('passwordChanged');


                                  

                                 return $this->refresh();
                    }
                 } 
                  else
                  {
                      $model->addError('oldpassword', 'Incorrect old password.');
                  }
            
         }
            return $this->render('change-password',
                            ['model'    =>$model]);
         
    }


      public function actionForget($email)
    {
       

        $model =   User::find()->where(['email'=>$email])->One();
        if(!$model){
            echo 0;
        }
        else
        {
            
        
        
        $model->ResetKey    = md5(time());
        $model->KeyDate     = date('Y-m-d h:i:s');

        if($model->save()){

                        $link =  $_SERVER['HTTP_HOST'].Yii::getAlias('@web')."/site/reset?key=".$model->ResetKey;
                     
                        //mail for user
                        
                          $email = \Yii::$app->mailer->compose()
                                            ->setTo($model->email)
                                            ->setFrom([\Yii::$app->params['adminEmail'] => \Yii::$app->name . ' robot'])
                                            ->setSubject('Signup Confirmation')
                                             ->setHtmlBody("Click this link to reset your password ".$link)
                                            ->send();

                          
                                }

                                echo 1;
        
        }
       
            
    }






    public function actionReset()
    {
        


       $key = $_REQUEST['key'];
       $member = User::find()->where(['ResetKey'=>$key])->one();
      

                   
       if(!$member)
       {
         Yii::$app->session->setFlash('InvalidVarification');
        return $this->render('varify');
        }

        else
        {
                    $datetime1 = date_create($member['KeyDate']);
                    $datetime2 = date_create(date('Y-m-d H:i:s'));

                    $interval = date_diff($datetime1, $datetime2);

                    $diff=  $interval->format('%R%a days');
                       
                  if($diff <1 )
                  {

                    $User =   User::find()->where(['id'=>$member['id']])->One();

                     if (isset($_REQUEST['password'])) {

                        $password      =  $_REQUEST['password'];
                        $NewPassword   =   Yii::$app->getSecurity()->generatePasswordHash($password);
               
                    
                            $User->password_hash  =   $NewPassword;
                            $confirm              =   $User->save();
                            if($confirm)
                            {       
                               
                                  $member->ResetKey = '1';
                                  $member->save();
                                
                               echo 1;
                            }
              

                     }
                    return $this->render('reset-password',['member'    =>$member]); 

                  //Yii::$app->session->setFlash('VarificationComplete');
                   //return $this->render('varify');
                }
                else
                {
               
                        Yii::$app->session->setFlash('keyExpire');
                        return $this->render('varify');
                }
           
        }
    
  } 
}
