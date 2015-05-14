<?php

/**
 * This is the model class for table "cms_limits".
 *
 * The followings are the available columns in table 'cms_limits':
 * @property integer $id
 * @property integer $id_user
 * @property integer $id_time_period
 * @property integer $limit
 * @property string $comment
 * @property integer $deleted
 */
class Limits extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cms_limits';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_user, id_time_period, limit', 'required'),
			array('id_user, id_time_period, limit', 'numerical', 'integerOnly'=>true),
			array('deleted', 'safe'),
			array('comment', 'length', 'max'=>1000),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_user, id_time_period, limit, comment', 'safe', 'on'=>'search'),
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
                    'time_period'=>array(self::BELONGS_TO, 'TimePeriod', 'id_time_period'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_user' => 'ID пользователя',
			'id_time_period' => 'ID временного периода',
			'limit' => 'Лимит',
			'comment' => 'Комментарий',
			'deleted' => 'Удалён',
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
                $criteria->with=('user');

		$criteria->compare('id',$this->id);
		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('id_time_period',$this->id_time_period);
		$criteria->compare('limit',$this->limit);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('deleted',$this->deleted,true); 
                
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
        
        /**
         * Проверяю, есть уже такой лимит или его нет
         * 
         * @param type $id_time_period
         * @param type $id_user
         * @return type
         */
        public static function checkPresense($id_time_period, $id_user)
        { 
            $position=Yii::app()->db->createCommand(
                                                     "SELECT*FROM `cms_limits` cl
                                                     WHERE cl.`id_time_period`='$id_time_period' AND
                                                           cl.deleted='0' AND
                                                           cl.`id_user`='$id_user'"
                                                       )->queryAll();
            return $position;
        }
        
        /**
         * Функция получения суммы лимитов за указанный временной интервал
         * @param type $id_time_period - временной интервал
         * @return type
         */
        public function getTotalLimit($id_time_period)
        {
            $limit=Yii::app()->db->createCommand(
                                                    "SELECT SUM(`limit`) AS `limit` FROM `cms_limits` "
                                                    . "WHERE `id_time_period`='$id_time_period'"
                                                 )->queryAll();
            return $limit;
        }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Limits the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
