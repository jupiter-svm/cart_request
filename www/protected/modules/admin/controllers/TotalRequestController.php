<?php

class TotalRequestController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='/layouts/column1';

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
				'actions'=>array('index', 'cartridge'),
				'roles'=>array('1','2'),
			),			
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
                if(Yii::app()->user->isGuest)
                {
                    $this->redirect('/site/login');
                }               
                
                //Получаю период или из списка выбора, или при нажатии на "Назад"
                //в списке картриджей. Если ничего нет, то выбираю первую заявку.
                //Нужно добавить возможность отображения последней по дате заявки
                if(isset($_POST['time_period']))
                {
                    $time_period=$_POST['time_period'];
                }
                else if(isset($_GET['idtimeperiod']))
                {
                    $time_period=$_GET['idtimeperiod'];
                }
                else
                {
                    $time_period='1';
                }
                
                //Получаю сумму лимитов за временной период
                $limit=Limits::getTotalLimit($time_period);                
                
                //Получаю сводную заявку из базы
                $total_request=RequestPosition::totalRequest($time_period);

		$this->render('index',array(
			'time_periods'=>TimePeriod::all(), 
                        'time_period'=>$time_period,
                        'total_request'=>$total_request,
                        'limit'=>$limit
		));
	}
        
        //Просмотр, в каких заявках фигурирует картридж
        public function actionCartridge($param)
        {
            if(Yii::app()->user->isGuest)
                {
                    $this->redirect('/site/login');
                }
                
                list($id_cartridge, $id_time_period)=explode('-', $param);
                
                $cartPos=RequestPosition::totalRequestCartridge($id_cartridge, $id_time_period);
                
                $this->render('cartridge', array('cartPos'=>$cartPos, 'id_time_period'=>$id_time_period));
        }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Cartridge the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Cartridge::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Cartridge $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='cartridge-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
