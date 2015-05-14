<?php

/**
 * This is the model class for table "cms_users".
 *
 * The followings are the available columns in table 'cms_users':
 * @property integer $id
 * @property string $short_name
 * @property string $password
 * @property string $name
 * @property string $surname
 * @property string $lastname
 * @property string $departament
 * @property string $staff_status
 * @property string $role
 * @property integer $ban
 * @property string $email
 * @property integer $created
 */
class User extends CActiveRecord
{
     const ROLE_ADMIN = 'administrator';
     const ROLE_USER = 'user';
    
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cms_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('short_name, password, name, surname, lastname', 'required'),
			array('ban', 'numerical', 'integerOnly'=>true),
			array('short_name, password, name, surname, lastname, departament, staff_status, email', 'length', 'max'=>255),
			array('role', 'length', 'max'=>1),
			array('created', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, short_name, password, name, surname, lastname, departament, staff_status, role, ban, email, created', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
                    
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'short_name' => 'Логин',
			'password' => 'Пароль',
			'name' => 'Имя',
			'surname' => 'Фамилия',
			'lastname' => 'Отчество',
			'departament' => 'Департамент',
			'staff_status' => 'Должность',
			'role' => 'Роль',
			'ban' => 'Бан',
			'email' => 'E-mail',
			'created' => 'Создан',
		);
	}
        
        protected function beforeSave(){
            
            //Перед сохранинием проверяю, чтобы не был сохранён текущий md5-пароль
            $pass=self::getPass(Yii::app()->user->id);
            $pass=$pass[0]['password'];
            
            if($this->password!=$pass)
            {
                $this->password=md5($this->password);
            }
            
            //$this->created=time();
            
            return parent::beforeSave();
        }
        
        //Делаем это для сортировки по полю фамилии
        public function scopes()
        {
            return array(
              'sort'=>array(
                  'order'=>'surname ASC'
              )
            );
        }

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

                if($this->scenario=='user_update')
                {
                    $criteria->compare('id',Yii::app()->user->id);
                }
                else
                {
                    $criteria->compare('id',$this->id);
                }
                
		
		$criteria->compare('short_name',$this->short_name,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('surname',$this->surname,true);
		$criteria->compare('lastname',$this->lastname,true);
		$criteria->compare('departament',$this->departament,true);
		$criteria->compare('staff_status',$this->staff_status,true);
		$criteria->compare('role',$this->role,true);
		$criteria->compare('ban',$this->ban);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('created',$this->created,true);
                
                //Сортирую пользователей по фамилии
                $sort=new CSort();
                $sort->defaultOrder='surname ASC';
                $sort->attributes=array('*');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'sort'=>$sort,
                        'pagination'=>array(
                            'pageSize'=>'50'
                        )
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Users the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function getPass($id)
        {
            return self::model()->findAllByAttributes(array('id'=>$id));
        }
        
        //Формирую правильный список пользователей для фильтра
        public static function all()
        {
            $total_name=array();
            
            $name=self::model()->sort()->findAll();  //Добавить критерий на выборку только не забаненных пользователей
            
            foreach($name as $item)
            {
                $total_name[]=array('id'=>$item['id'],'name'=>$item['surname'].' '.$item['name'].' '.$item['lastname']);
            }  
            
            return CHtml::listData($total_name,'id', 'name');
        }    
        
        //Формирую правильный список пользователей для фильтра. Только активные пользователи
        public static function allActive()
        {
            $total_name=array();
            
            $name=self::model()->sort()->findAllByAttributes(array('ban'=>'0'));  //Добавить критерий на выборку только не забаненных пользователей
            
            foreach($name as $item)
            {
                $total_name[]=array('id'=>$item['id'],'name'=>$item['surname'].' '.$item['name'].' '.$item['lastname']);
            }  
            
            return CHtml::listData($total_name,'id', 'name');
        }  
        
        /**
         * Проверяю, есть уже такой пользователь или его нет
         * 
         * @param type $date_start - начало периода
         * @param type $date_end - конец периода
         * @return type
         */
        public static function checkPresense($username)
        { 
            $position=Yii::app()->db->createCommand("SELECT*FROM `cms_user`
                                                     WHERE `short_name`='$username'"
                                                       )->queryAll();
            
           
            return $position;
        }
        
        /**
         * Получаю ФИО пользовалеля
         * @param type $id - ID пользователя
         * @return type
         */
        public static function getUsername($id)
        {
            $username=Yii::app()->db->createCommand("SELECT CONCAT(surname,' ',NAME,' ',lastname) AS username 
                                                     FROM `cms_user`
                                                     WHERE id=$id"
                                                       )->queryAll();
            
           
            return $username;
        }
        
        /**
         * Получаю отдел пользователя
         * @param type $id - ID заявки
         * @return type
         */
        public static function getDepartament($id)
        {
            $departament=Yii::app()->db->createCommand("SELECT cu.`departament` FROM `cms_request` cr
                                                        INNER JOIN `cms_user` cu ON(cr.`id_user`=cu.`id`)
                                                     WHERE cr.`id`=$id"
                                                       )->queryAll();
            
           
            return $departament;
        }
        
        //Проверяю e-mail
        public static function checkEmail($email)
        { 
            $position=Yii::app()->db->createCommand("SELECT*FROM `cms_user`
                                                     WHERE `email`='$email' AND `email`<>''"
                                                       )->queryAll();  
            return $position;
        }
        
        //Сбрасываю пароль пользователя
        public static function updatePass($pass, $email)
        {
            $update=Yii::app()->db->createCommand()->update('cms_user', array('password'=>$pass),
                                                            'email=:email', array(':email'=>$email));
            
            return $update;
        }       
}
