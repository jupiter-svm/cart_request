<?php

class RequestPositionController extends Controller
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
				'actions'=>array('index', 'view', 'create', 'update'),
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
	public function actionCreate($id)
	{
		$model=new RequestPosition;
                $model->id_request=$id;
                
                $timeStatus=Request::getCurTimeStatus($id);                
                $status=Request::getCurStatus($id);     
                
                //Список картриджей
                $cartridges=Cartridge::getAll();
                //Список адресов
                $addresses=Address::getAll();
                
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['RequestPosition']))
		{
			$model->attributes=$_POST['RequestPosition'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model, 'active'=>$timeStatus['active'],
                        'state'=>$status['status'], 'cartridges'=>$cartridges, 'addresses'=>$addresses
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
                
                //Проверяю временной интервал и статус заявки
                $timeStatus=Request::getCurTimeStatus($id);                
                $status=Request::getCurStatus($id); 

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['RequestPosition']))
		{
			$model->attributes=$_POST['RequestPosition'];
			if($model->save())
                            if($model->deleted=1)
				$this->redirect(array('index','id'=>$model->id_request));
                            else
                                $this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model, 'active'=>$timeStatus['active'], 'state'=>$status['status']
		));
	}
	
	/**
	 * Manages all models.
	 */
	public function actionIndex($id)
	{       //Проверяю запрос на удаление позиций заявки     
                if(isset($_POST['delete']))
                {                    
                    $model=RequestPosition::deletePosition($_POST['id_cartridge']);
                }
                
                //Сумма по заявке
                $sum=RequestPosition::sum($id);
                
                //Запрос на лимиты по заявке
                $limit=RequestPosition::getLimit($id);  
                
                //Проверяю статус текущей заявки
                $status=Request::getCurStatus($id); 
                
                //Не закрыт ли временной период
                $timeStatus=Request::getCurTimeStatus($id);
            
		$model=new RequestPosition('search');
		$model->unsetAttributes();  // clear any default values    
                //Просмотр заявок только текущей заявки
                $model->id_request=$id;                   
            
                //$model=RequestPosition::model()->findAllByAttributes(array('id_request'=>$id));
                
		if(isset($_GET['RequestPosition']))
			$model->attributes=$_GET['RequestPosition'];

		$this->render('index',array(
			'model'=>$model, 'sum'=>$sum, 'limit'=>$limit,
                        'active'=>$timeStatus['0']['active'], 'state'=>$status['status']
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return RequestPosition the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=RequestPosition::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param RequestPosition $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='request-position-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
