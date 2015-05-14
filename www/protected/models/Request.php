<?php

/**
 * This is the model class for table "cms_requests".
 *
 * The followings are the available columns in table 'cms_requests':
 * @property integer $id
 * @property integer $id_user
 * @property integer $id_time_period
 * @property integer $date_creation
 * @property integer $deleted
 * @property enum $status
 * @property string $person_in_charge
 * @property string $comment
 */
class Request extends CActiveRecord
{
    
        //Графа количества
        public $amount;
        
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cms_request';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_time_period', 'required'),
			array('id_user, id_time_period, deleted', 'numerical', 'integerOnly'=>true),
			array('comment, status, person_in_charge', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_user, id_time_period, date_creation, deleted, status, comment', 'safe', 'on'=>'search'),
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
                    'time_period'=>array(self::BELONGS_TO, 'TimePeriod', 'id_time_period'),
                    'user'=>array(self::BELONGS_TO, 'User', 'id_user'),
                    'cartridge'=>array(self::MANY_MANY, 'Cartridge', 'cms_request_position(id_request, id_cartrige)')                    
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_user' => 'Пользователь',
			'id_time_period' => 'Период формирования',
			'date_creation' => 'Дата создания',
			'deleted' => 'Удалена',
                        'status' => 'Статус',
                        'amount' => 'К/П',
                        'person_in_charge' => 'Ответственное лицо',
			'comment' => 'Комментарий',
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
                $criteria->with='user';

		$criteria->compare('id',$this->id);               
                
                //Для администраторов вывожу заявки всех пользователей
                if(Yii::app()->user->role!==2 && strpos($_SERVER['REQUEST_URI'],'admin')!==1)
                {                
                    $criteria->compare('id_user',Yii::app()->user->id);  //Вывожу заявки только текущего пользователя
                }
                else
                {
                    $criteria->compare('id_user',$this->id_user);  //Для администратора вывожу все заявки
                }
                
		$criteria->compare('id_time_period',$this->id_time_period);
		$criteria->compare('date_creation',$this->date_creation,true);
                
                //Удалённые заявки вывожу в админцентре
                if(Yii::app()->user->role!==2 && strpos($_SERVER['REQUEST_URI'],'admin')!==1)
                {                
                    $criteria->compare('deleted',($this->deleted==0)?'true':'false'); //Не вывожу удалённые заявки
                }
                else
                {
                    $criteria->compare('deleted', $this->deleted); //Вывожу удалённые заявки для администраторов
                }
                
		$criteria->compare('status',$this->status); //Не вывожу удалённые заявки
		$criteria->compare('status',$this->person_in_charge);
		$criteria->compare('comment',$this->comment,true);
                
                $sort=new CSort();                
               
                $sort->defaultOrder='t.id DESC';
                $sort->attributes=array(
                    'id_user'=>array(
                        'asc'=>'user.surname',
                        'desc'=>'user.surname DESC'
                    ),
                    '*'
                );                

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'pagination'=>array(
                            'pageSize'=>'50'
                        ),
                        'sort'=>$sort
		));
	}
        
        //Информация о текущей заявке (отсюда будем брать статус и состояние заявки)
        public static function getCurTimeStatus($id)
        {            
             $curTimeStatus=Yii::app()->db->createCommand("SELECT ctp.active FROM `cms_request` cr
                                                                   INNER JOIN `cms_time_period` ctp ON(ctp.`id`=cr.`id_time_period`)
                                                           WHERE cr.`id`=$id AND
                                                                 cr.`deleted`='0'"
                                                       )->queryAll();
            
            return $curTimeStatus;
        }       
        
        /**
         * Получаю статус заявки
         * @param type $id - ID заявки
         * @return type
         */
        public static function getCurStatus($id)
        {
            return self::model()->findByPk($id);
        }
        
        /**
         * Проверяю наличие существования заявки
         * 
         * @param type $id_time_period - ID временного периода
         * @param type $id_user - ID пользователя
         * @return type
         */
        public static function checkPresense($id_time_period, $id_user)
        { 
            $position=Yii::app()->db->createCommand("SELECT*FROM `cms_request` cr
                                                       INNER JOIN `cms_time_period` ctp ON(ctp.`id`=cr.`id_time_period`)
                                                     WHERE cr.`id_user`=$id_user AND
                                                           cr.deleted='0' AND
                                                           ctp.`id`=$id_time_period"
                                                       )->queryAll();
            return $position;
        }
        
        /**
         * Получаю пользователя, который завёл заявку
         * @param type $id - ID заявки
         * @return type
         */
        public static function getUser($id)
        { 
            $person=Yii::app()->db->createCommand("SELECT cu.`id` FROM `cms_request` cr
                                                        INNER JOIN `cms_user` cu ON(cu.`id`=cr.`id_user`)
                                                   WHERE cr.`id`=$id"
                                                       )->queryAll();
            
            $person=User::getUsername($person['0']['id']);
            
            return $person;
        }

        /**
         * Получаю временной промежуток заявки
         * @param type $id - ID заявки
         * @return type
         */
        public static function getTimePeriod($id)
        { 
            $time_period=Yii::app()->db->createCommand("SELECT ctp.`description` FROM `cms_request` cr
                                                            INNER JOIN `cms_time_period` ctp ON(ctp.`id`=cr.`id_time_period`)
                                                     WHERE cr.`id`=$id"
                                                       )->queryAll();
            return $time_period;
        }
        
        /**
         * Получаю материально-ответственное лицо
         * @param type $id - ID заявки
         * @return type
         */
        public static function getPersonInCharge($id)
        { 
            $person=Yii::app()->db->createCommand("SELECT `person_in_charge` FROM `cms_request`
                                                        WHERE id=$id"
                                                       )->queryAll();
            return $person;
        }
        
        //Меняю статус позиций заявки (групповое изменение)
        public static function updateStatusPosition($id, $status)
        {
            switch($status)
            {
                case 0: $status='opened'; break;
                case 1: $status='approved'; break;
                case 2: $status='closed'; break;
            }

            return self::model()->updateByPk($id, array('status'=>$status));
        }
        
        /**
         * Количество позиций в заявке
         * @param type $id_request - ID заявки
         * @return type
         */
        public static function getPositionsCount($id_request)
        { 
            $time_period=Yii::app()->db->createCommand("SELECT COUNT(*) AS amount FROM `cms_request_position`
                                                        WHERE `id_request`='$id_request' AND `deleted`='0'"
                                                       )->queryAll();            
            
            return $time_period['0']['amount'];
        }       
        
        /**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Request the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}    
        
        protected function beforeSave()
        {
            if($this->isNewRecord) 
            {
                $this->date_creation=time();
                $this->id_user=Yii::app()->user->id;
            }
            
            return parent::beforeSave();
        }
}
