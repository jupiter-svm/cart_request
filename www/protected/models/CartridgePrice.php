<?php

/**
 * This is the model class for table "cms_cartridge_price".
 *
 * The followings are the available columns in table 'cms_cartridge_price':
 * @property integer $id
 * @property integer $id_cartridge
 * @property integer $price
 */
class CartridgePrice extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cms_cartridge_price';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('price', 'required'),
			array('id_cartridge, price', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_cartridge, price', 'safe', 'on'=>'search'),
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
			'id_cartridge' => 'ID картриджа',
			'price' => 'Цена',
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
		$criteria->compare('id_cartridge',$this->id_cartridge);
		$criteria->compare('price',$this->price);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        /**
         * Обновляю цену картриджа
         * @param type $id - ID картриджа
         * @param type $price - цена картриджа
         * @return type
         */
        public static function updatePrice($id, $price)
        { 
            Yii::app()->db->createCommand("UPDATE `cms_cartridge_price` SET price=$price
                                                   WHERE `id_cartridge`=$id"
                                                       )->execute();           
        }
        
        /**
         * 
         * @param type $id - ID картриджа
         * @param type $price - цена картриджа
         */
        public static function insertPrice($id, $price)
        { 
            Yii::app()->db->createCommand("INSERT INTO `cms_cartridge_price` VALUES(NULL, '$id', '$price')"
                                                       )->execute();           
        }
        
        

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CartridgePrice the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
