<?php

class SettingController extends Controller
{
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

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
    
        
	public function actionIndex()
	{
		$model=Setting::model()->findByPk(1);          

                // Не работает AJAX проверка. Надо найти причину
                if(isset($_POST['ajax']) && $_POST['ajax']==='settings-index-form')
                {
                    echo CActiveForm::validate($model);
                    Yii::app()->end();
                }

                if(isset($_POST['Setting']))
                {
                    $model->attributes=$_POST['Setting'];
                    
                    if($model->save())
                    {
                        Yii::app()->user->setFlash('setting', 'Настройки успешно сохранены');                     
                    }                   
                }
                
                $this->render('index',array('model'=>$model));
        }        
}