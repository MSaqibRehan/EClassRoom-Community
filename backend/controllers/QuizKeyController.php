<?php

namespace backend\controllers;

use Yii;
use common\models\QuizKey;
use common\models\QuizKeySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use common\models\Quizz;
use yii\web\UploadedFile;   

/**
 * QuizKeyController implements the CRUD actions for QuizKey model.
 */
class QuizKeyController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'bulk-delete' => ['post'],
                ],
            ],
        ];
    }


    public function actionDeletekey(){
        return $this->renderAjax('deletekey');
    }

    /**
     * Lists all QuizKey models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new QuizKeySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single QuizKey model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "QuizKey #".$id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($id),
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
        }else{
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }

    /**
     * Creates a new QuizKey model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new QuizKey();  
 
       
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->quiz_key = UploadedFile::GetInstance($model, 'quiz_key') ) {
                $q_id=$model->quiz_id;
                $quiz=Quizz::find()->where(['quizz_id'=>$q_id])->one();

                
                
                    $im_name = $quiz->quizz_title; 
                    $name=str_replace(" ", "_", $im_name);
                    $name=$name."_key";
                
                    $model->quiz_key->SaveAs('uploads/' . $name . '.' . $model->quiz_key->extension);
                    $model->quiz_key =$name . '.' . $model->quiz_key->extension;
                    if ($model->save()) {
                        echo "<script>window.close();</script>";
                    }else{
                        echo "something went wrong";
                    }
                
                
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        
       
    }

    /**
     * Updates an existing QuizKey model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);       

            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->quiz_key = UploadedFile::GetInstance($model, 'quiz_key')) {

                    $q_id=$model->quiz_id;
                    $quiz=Quizz::find()->where(['quizz_id'=>$q_id])->one();
                   
                    $im_name = $quiz->quizz_title; 
                    $name=str_replace(" ", "_", $im_name);
                    $name=$name."_key";
                
                    $model->quiz_key->SaveAs('uploads/' . $name . '.' . $model->quiz_key->extension);
                    $model->quiz_key =$name . '.' . $model->quiz_key->extension;

                        if ($model->save()) {
                            echo "<script>window.close();</script>";
                        }else{
                            echo "something went wrong";
                        }
                    
                
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        
    }

    /**
     * Delete an existing QuizKey model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $this->findModel($id)->delete();

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }


    }

     /**
     * Delete multiple existing QuizKey model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionBulkDelete()
    {        
        $request = Yii::$app->request;
        $pks = explode(',', $request->post( 'pks' )); // Array or selected records primary keys
        foreach ( $pks as $pk ) {
            $model = $this->findModel($pk);
            $model->delete();
        }

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }
       
    }

    /**
     * Finds the QuizKey model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return QuizKey the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = QuizKey::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
