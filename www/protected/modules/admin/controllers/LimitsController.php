<?php

class LimitsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='/layouts/column2';

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
				'actions'=>array('index', 'view', 'create', 'update', 'move'),
				'roles'=>array('2'),
			),			
			array('deny',  // deny all users
				'users'=>array('*'),
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
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Limits;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Limits']))
		{
			$model->attributes=$_POST['Limits'];
                        
                        if(!count(Limits::checkPresense($model->id_time_period, $model->id_user)))
                        {
                            if($model->save())
                                    $this->redirect(array('view','id'=>$model->id));
                        }
                        else
                        {
                            Yii::app()->user->setFlash('limit_create', 'Лимит уже существует');
                        }
		}                
                
		$this->render('create',array(
			'model'=>$model, 'user_filter'=>User::all(), 'time_period'=>TimePeriod::all()
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

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Limits']))
		{
			$model->attributes=$_POST['Limits'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model, 'user_filter'=>User::allActive(), 'time_period'=>TimePeriod::all()
		));
	}	

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
                if(isset($_POST['statusval']))
                {                    
                    $model=Limits::updateStatusPosition($_POST['id'], $_POST['statusval']);
                }
            
		$model=new Limits('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Limits']))
			$model->attributes=$_GET['Limits'];

		$this->render('index',array(
			'model'=>$model, 'time_period'=>TimePeriod::all(),
                        'user_filter'=>User::allActive()
		));
	}   
        
        /**
         * Копирование лимитов
         */
        public function actionMove()
        {
                 if(isset($_POST['from']) && isset($_POST['to']))
                {    //Флаг наличия ошибок  
                     $errFlag=0;
                     
                    if($_POST['from']==$_POST['to'])
                    {
                        Yii::app()->user->setFlash('equal', 'Нельзя копировать лимиты в одном периоде');
                        $errFlag=1; //Устанавливаю флаг наличия ошибок
                    }
                    
                    if(Limits::getLimitsCount($_POST['to']))
                    {
                        Yii::app()->user->setFlash('notempty', 'В данном периоде уже есть лимиты');
                        $errFlag=1; //Устанавливаю флаг наличия ошибок
                    }
                    
                    if(!$errFlag)
                    {
                        if(Limits::moveLimits($_POST['from'], $_POST['to']))
                        {
                            Yii::app()->user->setFlash('success', 'Данные успешно скопированы');
                        }
                        else
                        {
                            Yii::app()->user->setFlash('nosuccess', 'Не удалось скопировать данные');
                        }
                    }
                }
            
                $model=new Limits('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Limits']))
			$model->attributes=$_GET['Limits'];

		$this->render('move',array(
			'model'=>$model, 'time_period'=>TimePeriod::all()
		));
        }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Limits the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Limits::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Limits $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='limits-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
