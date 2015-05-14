<?php

/**
 * This is the model class for table "cms_cartridges".
 *
 * The followings are the available columns in table 'cms_cartridges':
 * @property integer $id
 * @property string $name
 * @property string $comment
 * @property integer $deleted
 */
class Cartridge extends CActiveRecord
{
        //Добавляю цену. В таблице столбец отсутствует. При создании связи нет с таблицей ценнников,
        //но это нужно при добавлении нового картриджа
        public $price='';
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cms_cartridge';
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
			array('price', 'required', 'on'=>'cartridgecreate'),
			array('name', 'length', 'max'=>255),
                        array('deleted', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, comment, deleted', 'safe', 'on'=>'search'),
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
                    'request'=>array(self::MANY_MANY, 'Request', 'cms_request_position(id_cartrige, id_request)'),
                    'cartridge_price'=>array(self::HAS_ONE, 'CartridgePrice', 'id_cartridge'),
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
                        'price'=>'Цена',
			'comment' => 'Комментарий',
			'deleted' => 'Статус',
		);
	}
        
        //Сортировка картриджа по названию
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
		$criteria->compare('comment',$this->comment,true);
                
                if(Yii::app()->user->role!==2 && strpos($_SERVER['REQUEST_URI'],'admin')!==1)
                {
                    $criteria->compare('deleted',($this->deleted==0)?'true':'false');
                }
                else
                {
                    $criteria->compare('deleted',$this->deleted,true);
                }
                
                //Сортирую картриджи по имени во всех таблицах отображения (сайт, админка)
                $sort=new CSort();
                $sort->defaultOrder='name ASC';
                $sort->attributes=array('*');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'sort'=>$sort,
                        'pagination'=>array(
                            'pageSize'=>'50'
                        )
		));
	}
        
        //Получаю список всех картриджей
        public static function getAll() 
        {
            //Не вывожу удалённые картриджи в общий список
            $criteria=new CDbCriteria();            
            $criteria->addCondition('deleted=0');
            
            return CHtml::listData(self::model()->sort()->findAll($criteria), 'id', 'name');
        }       
        
        /**
         * Проверяю наличие существования картриджа
         * 
         * @param type $cartridge_name - название картриджа
         * @return type
         */
        public static function checkPresense($cartridge_name)
        {              
            
            $position=Yii::app()->db->createCommand("SELECT*FROM `cms_cartridge` c
                                                     WHERE c.`name`='$cartridge_name'"
                                                       )->queryAll();
            return CHtml::listData($position, 'id', 'name');
        }
        
        /**
         * Обновление цены картриджа в новую таблицу
         * @param type $id - ID картриджа
         * @param type $price - цена картриджа
         */
        public static function addCartridgePrice($id, $price)
        {
            self::model()->updateByPk($id, array('price'=>$price));
        }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Cartridge the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
