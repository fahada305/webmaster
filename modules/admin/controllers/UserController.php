<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Session;
use yii\data\Pagination;
use app\models\User;
use app\models\AddUser;
use app\models\AuthItem;
use app\models\AuthAssignment;
use app\modules\admin\models\UserSearch;


/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    public function behaviors()
    {
        return [

               


            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */

    public function actionIndex()
    {
        $searchModel = new UserSearch();
         $cond = "1 " ;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$cond);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
   
   

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {	    
    	
        return $this->render('view', [
            'model' => $this->findModel($id),
           
        ]);
    }


    public function actionStatus($val,$id)
    {	
    	 $model = $this->findModel($id);
    	 $model->status = $val;
    	 $model->save();
    	return $this->redirect(Yii::$app->request->referrer);
        
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionAddUser()
    {
        $model = new AddUser();   
        
        $authItem   =   Yii::$app->authManager->getRoles();//AuthItem::find()->all();

        $cls = ''; // hide role on update for admin

        if ($model->load(Yii::$app->request->post()) ) 
         {

            if($user = $model->adduser()){
                              
                return $this->redirect(['view', 'id' => $user->id]);
               
           }
                    
           
        }

        return $this->render('create', [
            'model' => $model,
            'authItem'  =>  $authItem,
            
             'cls'=>$cls
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
       $model = User::findOne($id);
      
       $authItem   =   Yii::$app->authManager->getRoles();

    

     if($id == 1){
     	$cls = 'hide';
     }else{
     	$cls = '';
     }

     
      
     if ($model->load(Yii::$app->request->post())) 
        {
		
			if(trim($model->password)!='')
            {
                $model->setPassword($model->password);
			}

			  
          
			$model->save();

			if($model->user_role		!= '')
            {
				$assign	=	AuthAssignment::find()->where(['user_id'=>$model->id])->One();
				$assign->item_name	=	$model->user_role;
				$assign->save();
							
			}
			
			
          return $this->redirect(['view', 'id' => $model->id]);
        } else {

        	
            return $this->render('update', [
                'model' => $model,
                'authItem'  =>  $authItem,
                
                'cls'=>$cls,
                
            ]);
        }
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {

        $role = AuthAssignment::find()->where(['user_id'=>$id])->one();
       
        $this->findModel($id)->delete();

        $role->delete();

        return $this->redirect(Yii::$app->request->referrer);
    }



   
    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
	
   
}
