<?php

class PrintController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='/layoutPrint/base';

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
				'actions'=>array('request'),
				'roles'=>array('1','2'),
			),		
                        array('allow', 
				'actions'=>array('totalrequest'),
				'roles'=>array('2'),
                        ),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
         * Вид заявки для печати
         * @param type $id - ID заявки
         */
	public function actionRequest($id)
	{
                //Сумма по заявке
                $sum=RequestPosition::sum($id);                                
            
		$model=RequestPosition::printRequest($id);
                
                //Получаю ФИО пользователя
                $username=Request::getUser($id);
                $username=$username['0']['username'];                 
                
                //Получаю отдел пользователя
                $departament=User::getDepartament($id);
                $departament=$departament['0']['departament'];
                
                //Получаю временной период заявки
                $time_period=Request::getTimePeriod($id);
                $time_period=$time_period['0']['description'];
                
                //Получаю ответственное лицо
                $person=Request::getPersonInCharge($id);
                $person=$person['0']['person_in_charge'];
            
		$this->render('request',array(
			'request'=>$model, 'sum'=>$sum, 'time_period'=>$time_period,
                        'username'=>$username, 'departament'=>$departament, 'person'=>$person
		));
	}
        
        /**
         * Печать сводной заявки
         * 
         * @param type $time_period - ID временного периода
         */
        public function actionTotalRequest($time_period)
        {                       
                //Получаю название временного периода
                $tperiod_name=TimePeriod::getTPeriodName($time_period);
                
                //Получаю сводную заявку из базы
                $total_request=RequestPosition::totalRequest($time_period);

		$this->render('totalRequest',array(
			'time_periods'=>TimePeriod::all(), 
                        'time_period'=>$time_period,
                        'total_request'=>$total_request,
                        'tperiod_name'=>$tperiod_name
		));
        }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return TimePeriod the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=TimePeriod::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param TimePeriod $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='time-period-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
