<?php

class RequestController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index', 'view', 'create', 'update'),
				'roles'=>array('1','2'),
			),			
			array('deny',  // deny all users
				'users'=>array('?'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id)
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Request;               

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Request']))
		{
			$model->attributes=$_POST['Request'];                        
                        
                        if(!count(Request::checkPresense($model->id_time_period, Yii::app()->user->id)))
                        {
                            if($model->save())
                                    $this->redirect(array('view','id'=>$model->id));
                        }
                        else
                        { 
                            Yii::app()->user->setFlash('request_update', 'Заявка уже существует');                            
                        }
		}

		$this->render('create',array(
			'model'=>$model, 'time_period'=>TimePeriod::allActive(), 'time_period_active'=>TimePeriod::allActive()
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);                
                
                $timeStatus=Request::getCurTimeStatus($id);                
                $status=Request::getCurStatus($id);   

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['Request']))
		{
			$model->attributes=$_POST['Request'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model, 'active'=>$timeStatus[0]['active'], 'state'=>$status['status']
		));
	}	

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{    
                
		$model=new Request('search');
		$model->unsetAttributes();  // clear any default values               
                
		if(isset($_GET['Request']))
			$model->attributes=$_GET['Request'];

		$this->render('index',array(
			'model'=>$model, 'time_period'=>TimePeriod::all(), 
                        'time_period_no_active'=>TimePeriod::allActive(), 'users'=>User::all()
		));
	}     
        

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Request the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Request::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Request $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='request-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}        
}
