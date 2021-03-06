<?php

/**
 * This is the model class for table "cms_address".
 *
 * The followings are the available columns in table 'cms_address':
 * @property integer $id
 * @property integer $id_address_group
 * @property integer $id_user
 * @property string $address
 * @property integer $active
 */
class Address extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cms_address';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_user, address', 'required'),
                        array('id_address_group', 'safe'),
			array('id_user, active', 'numerical', 'integerOnly'=>true),
			array('address', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_user, address, active, id_address_group', 'safe', 'on'=>'search'),
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
                    'user'=>array(self::BELONGS_TO, 'User', 'id_user'),
                    'address_group' => array(self::BELONGS_TO, 'AddressGroup', 'id_address_group'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_address_group' => 'Группа',
			'id_user' => 'Пользователь',
			'address' => 'Адрес',
			'active' => 'Доступность',
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
		$criteria->compare('id_address_group',$this->id_address_group);
		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('active',$this->active);
                
                $sort=new CSort();                
               
                $sort->defaultOrder='user.surname';
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
        
        //Получаю список всех адресов
        public static function getAll() 
        {            
            return CHtml::listData(self::model()->findAll(array('order'=>'address asc')), 'id', 'address');
        }
        
        //Получаю список всех адресов с для определённого пользователя
        public static function getAllByUser($id_user) 
        {           
            $c=new CDbCriteria;
            
            $c->select='*';
            $c->alias='ca';
            $c->join="INNER JOIN `cms_user` cu ON(cu.`id`=ca.`id_user`)";
            $c->condition="cu.`id`='$id_user'";
            
            return CHtml::listData(self::model()->findAll($c), 'id', 'address');           
        }
        
        //Получаю список всех адресов с для определённого пользователя
        //для view пользователя
        public static function getAllByUserToView($id_user) 
        {           
            $c=new CDbCriteria;
            
            $c->select='*';
            $c->alias='ca';
            $c->join="INNER JOIN `cms_user` cu ON(cu.`id`=ca.`id_user`)";
            $c->condition="cu.`id`='$id_user'";
            
            return self::model()->findAll($c);           
        }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Address the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
