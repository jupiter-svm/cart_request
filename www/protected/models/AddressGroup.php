<?php

/**
 * This is the model class for table "cms_address_group".
 *
 * The followings are the available columns in table 'cms_address_group':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $deleted
 */
class AddressGroup extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cms_address_group';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
                        array('name', 'safe'),
			array('deleted', 'numerical', 'integerOnly'=>true),
			array('name, description', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, description, deleted', 'safe', 'on'=>'search'),
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
			'name' => 'Название',
			'description' => 'Описание',
			'deleted' => 'Удалена',
		);
	}
        
        //Делаем это для сортировки по полю фамилии
        public function scopes()
        {
            return array(
              'sort'=>array(
                  'order'=>'name ASC'
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

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('deleted',$this->deleted);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        /**
         * Формирую правильный список пользователей для фильтра
         */
        public static function all()
        {
            $total_name=array();
            
            $name=self::model()->sort()->findAll();  //Добавить критерий на выборку только не забаненных пользователей
            
            foreach($name as $item)
            {
                $total_name[]=array('id'=>$item['id'],'name'=>$item['name']);
            }  
            
            return CHtml::listData($total_name,'id', 'name');
        } 
        
        //Получаю список всех адресов
        public static function getAll() 
        {            
            return CHtml::listData(self::model()->findAll(array('order'=>'name asc')), 'id', 'name');
        }
        
        public static function getAddrName($id)
        {
            return self::model()->findAllByPk($id);
        }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AddressGroup the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
