<?php

namespace app\modules\advertiser\controllers;

use Yii;
use app\modules\advertiser\models\Campaigns;
use app\modules\advertiser\models\CampaignsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\advertiser\models\Teasers;
use yii\data\ActiveDataProvider;


/**
 * CampaignsController implements the CRUD actions for Campaigns model.
 */
class CampaignsController extends Controller
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
     * Lists all Campaigns models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CampaignsSearch();

        $cond = "user_id = ".Yii::$app->user->identity->id ." and status != -1 ";
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$cond);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Campaigns model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Campaigns model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Campaigns();

        if ($model->load(Yii::$app->request->post()) ) {

           
            /* implode array to string to store in db */
            if($model->ban_country)
            {
                $model->ban_country = implode(',', $model->ban_country);
            }

             if($model->OS)
            {
                $model->OS = implode(',', $model->OS);
            }

             if($model->device)
            {
                $model->device = implode(',', $model->device);
            }

             if($model->ban_hour)
            {
                $model->ban_hour = implode(',', $model->ban_hour);
            }

             if($model->ban_week_day)
            {
                $model->ban_week_day = implode(',', $model->ban_week_day);
            }

            $model->user_id = Yii::$app->user->identity->id;

            $model->status = 2;

            $model->dataadd = date('Y-m-d h:i:s');

            $model->save();

            Yii::$app->session->setFlash('savedSuccess');

            return $this->redirect(['index']); 
            
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Campaigns model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        //check access
        if($model->user_id == Yii::$app->user->identity->id){

        /* explode the string in array to show selected values in form */

            if($model->ban_country)
            {
                $model->ban_country = explode(',', $model->ban_country);
            }

             if($model->OS)
            {
                $model->OS = explode(',', $model->OS);
            }

             if($model->device)
            {
                $model->device = explode(',', $model->device);
            }

             if($model->ban_hour)
            {
                $model->ban_hour = explode(',', $model->ban_hour);
            }

             if($model->ban_week_day)
            {
                $model->ban_week_day = explode(',', $model->ban_week_day);
            }


        if ($model->load(Yii::$app->request->post()) ) {



            /* implode array to string to store in db */
            if($model->ban_country)
            {
                $model->ban_country = implode(',', $model->ban_country);
            }

             if($model->OS)
            {
                $model->OS = implode(',', $model->OS);
            }

             if($model->device)
            {
                $model->device = implode(',', $model->device);
            }

             if($model->ban_hour)
            {
                $model->ban_hour = implode(',', $model->ban_hour);
            }

             if($model->ban_week_day)
            {
                $model->ban_week_day = implode(',', $model->ban_week_day);
            }

            $model->save();

            Yii::$app->session->setFlash('savedSuccess');

               return $this->redirect(['index']); 
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }else{

            // if he is not creater then go back to index page

            return $this->redirect(['index']); 
        }
    }

    /**
     * Deletes an existing Campaigns model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model          =   $this->findModel($id);

        $model->status  = -1;
            
        if($model->save())
        {
            // change status of all ads with this campaign_id

            $model2 = Teasers::find()->where(['campaign_id'=>$id])->all();

                foreach ($model2 as $key => $value) 
                {
                    
                    $value->status      = -1;
            
                    $value->save();
                }
        }

        return $this->redirect(['index']);
    }



    /*  function to switch the status  */

    public function actionStatus($id,$act)
    {
        $model          =   $this->findModel($id);

        $model->status  = $act;
            
        if($model->save())
        {

            // change status of all ads with this campaign_id

            $model2 = Teasers::find()->where(['campaign_id'=>$id])->all();

                foreach ($model2 as $key => $value) 
                {
                    
                    $value->status      = $act;
            
                    $value->save();
                }

         Yii::$app->session->setFlash('savedSuccess');

        }


        return $this->redirect(['index']);
    }

    /**
     * Finds the Campaigns model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Campaigns the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Campaigns::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /** functions for teasers goes here ..... **/


      /**
     * Lists all Teasers models.
     * @return mixed
     */
    public function actionTeaser($id)
    {   
        // status = -1 means the ads has deleted so they will not visisble to list

        $dataProvider = new ActiveDataProvider([
            'query' => Teasers::find()->where(['campaign_id'=>$id])->andwhere("status != -1 "),
        ]);

        return $this->render('teaser', [
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Creates a new Teasers model.
     * If creation is successful, the browser will be redirected to the 'teaser' page.
     * @return mixed
     */

     public function actionCreateTeaser($id)
    {
        $model      = new Teasers();
        $Campaign   = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            $model->campaign_id = $id;
            $model->user_id     = Yii::$app->user->identity->id;
            $model->ban_site    = $Campaign->ban_site;
            $model->section_id  = $Campaign->section_id;
            $model->ban_country = $Campaign->ban_country;
            $model->ban_hour    = $Campaign->ban_hour;
            $model->ban_week_day= $Campaign->ban_week_day;
            $model->dataadd     = date('Y-m-d h:i:s');
            $model->status      = 1;

            $model->save();


            /* function to save image , written at models/Teasers in side this module
            * this function must be call after save() to get $model->id in this action
            */

            $model->saveImage($_POST['img'],$model->id,$_FILES);



            return $this->redirect(['teaser', 'id' => $id]);
        } else {
            return $this->render('create-teaser', [
                'model' => $model,
            ]);
        }
    }

     /**
     * Updates an existing Teasers model.
     * If update is successful, the browser will be redirected to the 'teaser' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdateTeaser($id)
    {
        $model = Teasers::findOne($id);

        if ($model->load(Yii::$app->request->post())) {


            // function to save image , written at models/Teasers in side this module


            $model->saveImage($_POST['img'],$model->id,$_FILES);



             $model->dataedit     = date('Y-m-d h:i:s');

              $model->status      = 1;
            
             $model->save();

            return $this->redirect(['teaser', 'id' => $model->campaign_id]);

        } else {
            return $this->render('update-teaser', [
                'model' => $model,
            ]);
        }
    }

      /**
     * Deletes an existing Teasers model.
     * If deletion is successful, the browser will be redirected to the 'teaser' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDeleteTeaser($id)
    {
       $model = Teasers::findOne($id);

        $model->status      = -1;
            
        $model->save();

        return $this->redirect(['teaser', 'id' => $model->campaign_id]);
    }
}
