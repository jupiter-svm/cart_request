<?php

class UserController extends Controller
{
	public function actionIndex()
	{
		$model=$this->loadModel(Yii::app()->user->id);   
                
		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			if($model->save())
				$this->redirect(array('index'));
		}

		$this->render('index',array(
			'model'=>$model,
		));
	}
        
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
				'actions'=>array('index'),
				'roles'=>array('1','2'),
			),	
                        array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('fgtpassword'),
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('?'),
			),
		);
	}
        

	public function loadModel($id)
	{
		$model=User::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
        
        /*
         * Функция восстановления пароля
         */
        public function actionFgtpassword()
	{           
            $model=new User;
            
            if(isset($_POST['User']))
            { 
                //Проверяю, существует ли пользователь с таким e-mail в БД
                if(count(User::checkEmail($_POST['User']['email'])))
                { 
                    //Генерирую новый пароль
                    $newPass=rand(100000, 999999);
                    
                    if(User::updatePass(md5($newPass), $_POST['User']['email']))
                    {                    
                        mail($_POST['User']['email'],'Восстановление пароля','Новый пароль: '.$newPass);
                        Yii::app()->user->setFlash('contact','Новый пароль выслан на указанный почтовый ящик'); 
                    }
                    else
                    {
                        Yii::app()->user->setFlash('erorr','Не удалось сбросить пароль');
                    }
                }
                else
                {
                    Yii::app()->user->setFlash('error','Указанный e-mail не удалось найти в базе данных');
                }
            }
            
            $this->render('fgtpassword', array(
			'model'=>$model
		));
	}
}