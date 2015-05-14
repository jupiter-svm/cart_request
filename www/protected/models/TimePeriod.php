<?php

/**
 * This is the model class for table "cms_time_period".
 *
 * The followings are the available columns in table 'cms_time_period':
 * @property integer $id
 * @property string $description
 * @property integer $date_start
 * @property integer $date_end
 * @property integer $active
 */
class TimePeriod extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cms_time_period';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('description, date_start, date_end', 'required'),
			array('active', 'numerical', 'integerOnly'=>true),
			array('description', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, description, date_start, date_end, active', 'safe', 'on'=>'search'),
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
			'description' => 'Описание',
			'date_start' => 'Дата начала',
			'date_end' => 'Дата окончания',
			'active' => 'Активен',
		);
	}
        
        //Делаем это для сортировки по полю id в убывающем порядке,
        //чтобы выводить последний период в сводной заявке
        public function scopes()
        {
            return array(
              'sort'=>array(
                  'order'=>'id ASC'
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
		$criteria->compare('description',$this->description,true);
		$criteria->compare('date_start',$this->date_start,true);
		$criteria->compare('date_end',$this->date_end,true);
		$criteria->compare('active',$this->active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TimePeriod the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public static function allActive()
        {          
            return CHtml::listData(self::model()->findAllByAttributes(array('active'=>'1')), 'id', 'description');
        }
        
        //Поправить названия. Поменять с функцией all()
        public static function all()
        {          
            return CHtml::listData(self::model()->findAll(), 'id', 'description');
        }
        
        /**
         * Получаю название временного периода по ID
         * 
         * @param type $id - ID временного периода
         * @return type1
         */
        public static function getTPeriodName($id)
        {
            return self::model()->findByPk($id);
        }
        
//        public static function getCurStatus($id)
//        {            
//            return self::model()->findByPk($id);
//        }       
}
