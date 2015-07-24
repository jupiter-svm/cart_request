<?php

/**
 * This is the model class for table "cms_request_position".
 *
 * The followings are the available columns in table 'cms_request_position':
 * @property integer $id
 * @property integer $id_request
 * @property integer $id_cartridge
 * @property integer $id_address
 * @property integer $amount
 * @property integer $price
 * @property string $comment
 * @property integer $deleted
 */
class RequestPosition extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cms_request_position';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_request, id_cartridge, id_address, amount, deleted', 'required'),
                        array('price', 'safe', 'on'=>'create'),
			array('id_request, id_cartridge, id_address', 'numerical', 'integerOnly'=>true),
			array('comment', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_request, id_cartridge, id_address, comment, deleted', 'safe', 'on'=>'search'),
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
                    'request'=>array(self::BELONGS_TO, 'Request', 'id_request'),
                    'cartridge'=>array(self::BELONGS_TO, 'Cartridge', 'id_cartridge'),
                    'address'=>array(self::BELONGS_TO, 'Address', 'id_address')
                    
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_request' => 'ID заявки',
			'id_cartridge' => 'ID картриджа',
			'id_address' => 'Адрес',
			'amount' => 'Количество',
			'price' => 'Цена',
			'comment' => 'Комментарий',
                        'deleted' => 'Доступность'
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
		$criteria->compare('id_request',$this->id_request);
		$criteria->compare('id_cartridge',$this->id_cartridge);
		$criteria->compare('id_address',$this->id_address);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('price',$this->price);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('deleted',$this->deleted,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'pagination'=>array(
                            'pageSize'=>'50'
                        )
		));
	}  
        
        //Вывод суммы заявки
        public static function sum($id)
        {
            $sumCriteria=Yii::app()->db->createCommand("SELECT SUM(rp.amount*rp.price) as sum FROM cms_cartridge_price cp
                                                            INNER JOIN cms_cartridge c ON(cp.id_cartridge=c.id)
                                                            INNER JOIN cms_request_position rp ON(rp.id_cartridge=c.id)
                                                        WHERE rp.`id_request`=$id AND 
                                                          rp.`deleted`='0'"
                                                       )->queryAll();
            
            return $sumCriteria;
        }
        
        //Вывод суммы заявки по группам адресов
        public static function sumAddrPeriod($id, $id_period)
        {
            if(!isset($id_period))
            {
                $sumCriteria=Yii::app()->db->createCommand("SELECT SUM(rp.amount*rp.price) as sum FROM cms_cartridge_price cp
                                                                INNER JOIN cms_cartridge c ON(cp.id_cartridge=c.id)
                                                                INNER JOIN cms_request_position rp ON(rp.id_cartridge=c.id)
                                                            WHERE rp.`id_request`=$id AND 
                                                              rp.`deleted`='0'"
                                                           )->queryAll();
            }
            else
            {
                $sumCriteria=Yii::app()->db->createCommand("SELECT SUM(rp.amount*rp.price) as sum FROM cms_cartridge_price cp
                                                                INNER JOIN cms_cartridge c ON(cp.id_cartridge=c.id)
                                                                INNER JOIN cms_request_position rp ON(rp.id_cartridge=c.id)
                                                                INNER JOIN cms_address ca ON(ca.id=rp.id_address)
                                                                INNER JOIN cms_address_group cag ON(cag.id=ca.id_address_group)
                                                            WHERE rp.`id_request`=$id AND 
                                                                  cag.id=$id_period AND
                                                                  rp.`deleted`='0'"
                                                           )->queryAll();
            }
            
            return $sumCriteria;
        }
        
        //Удаление позиций заявки
        public static function deletePosition($id)
        {
            return self::model()->updateByPk($id, array('deleted'=>1));
        }
        
        //Функция вывода лимита по периоду времени
        public static function getLimit($id)
        {
            $limit=Yii::app()->db->createCommand("SELECT cl.limit FROM `cms_request` cr
                                                    INNER JOIN `cms_user` cu ON (cu.`id`=cr.`id_user`)	
                                                    INNER JOIN `cms_time_period` ctp ON(ctp.`id`=cr.`id_time_period`)
                                                    INNER JOIN `cms_limits` cl ON(cl.`id_time_period`=ctp.`id` AND cl.`id_user`=cu.`id`)
                                                 WHERE cr.`id`=$id AND cl.deleted=0"
                                                       )->queryAll();
            return $limit;
        }   
        
        //Запрос на формирование сводной заявки
        public static function totalRequest($time_period)
        {
            $total=Yii::app()->db->createCommand("SELECT crp.`id_cartridge`, cc.`name` AS cart_name, SUM(crp.`amount`) AS summa, 
                                                         crp.`price`, SUM(crp.`amount`)*crp.`price` AS total, cr.`id_time_period`
                                                  FROM `cms_request_position` crp
                                                          INNER JOIN `cms_request` cr ON(cr.`id`=crp.`id_request`)
                                                          INNER JOIN `cms_time_period` ctp ON(ctp.`id`=cr.`id_time_period`)
                                                          INNER JOIN `cms_cartridge` cc ON(cc.`id`=crp.`id_cartridge`)
                                                  WHERE ctp.`id`=$time_period AND
                                                        crp.`deleted`='0' AND cr.deleted='0'
                                                  GROUP BY cc.name"
                                                       )->queryAll();
            return $total;
        }       
        
        //Получаю картриджи по заявкам для сводной заявки
        public static function totalRequestCartridge($id_catrtridge, $id_time_period)
        {
            $cartPos=Yii::app()->db->createCommand("SELECT cr.`id`, ctp.`description`, cr.`comment` AS cr_comment, cc.`name`, crp.`comment` AS crp_comment, 
                                                           crp.`amount`, crp.`price`, (crp.`amount`*crp.`price`) AS summ , ca.address,
                                                           CONCAT(cu.`surname`,' ',cu.name,' ',cu.lastname) AS username
                                                    FROM `cms_request_position` crp
                                                            INNER JOIN `cms_request` cr ON(cr.`id`=crp.`id_request`)
                                                            INNER JOIN `cms_user` cu ON(cu.`id`=cr.`id_user`)
                                                            INNER JOIN `cms_cartridge` cc ON(cc.`id`=crp.`id_cartridge`)
                                                            INNER JOIN `cms_time_period` ctp ON(ctp.`id`=cr.`id_time_period`)
                                                            INNER JOIN `cms_address` ca ON(ca.id=crp.id_address)
                                                    WHERE crp.`deleted`='0' AND
                                                          cr.`deleted`='0'  AND
                                                          cr.`id_time_period`=$id_time_period AND
                                                          crp.`id_cartridge`=$id_catrtridge
                                                          ORDER BY cu.surname"
                                                       )->queryAll();
            return $cartPos;
        }
        
        /**
         * Вывожу список позиций для печати
         * @param type $id_request - Передаю ID заявки
         */
        public static function printRequest($id_request, $id_group)
        {
            if(!isset($id_group))
            {            
                $printRes=Yii::app()->db->createCommand("SELECT cc.`name`, crp.`amount`, crp.`price`, (crp.`amount`*crp.`price`) AS summ,
                                                                 ca.`address`, crp.`comment`
                                                         FROM `cms_request_position` crp
                                                                 INNER JOIN `cms_cartridge` cc ON(cc.`id`=crp.`id_cartridge`)
                                                                 INNER JOIN `cms_address` ca ON(ca.`id`=crp.`id_address`)
                                                         WHERE crp.`id_request`=$id_request AND
                                                               crp.`deleted`='0'"
                                                          )->queryAll();
            }
            else
            {
                $printRes=Yii::app()->db->createCommand("SELECT cc.`name`, crp.`amount`, crp.`price`, (crp.`amount`*crp.`price`) AS summ,
                                                                 ca.`address`, crp.`comment`
                                                         FROM `cms_request_position` crp
                                                                 INNER JOIN `cms_cartridge` cc ON(cc.`id`=crp.`id_cartridge`)
                                                                 INNER JOIN `cms_address` ca ON(ca.`id`=crp.`id_address`)
                                                                 INNER JOIN `cms_address_group` cag ON(cag.`id`=ca.`id_address_group`)
                                                         WHERE crp.`id_request`=$id_request AND
                                                               cag.`id`=$id_group AND 
                                                               crp.`deleted`='0'"
                                                          )->queryAll();
            }
            
            return $printRes;
        }
        
        /**
         * Получаю статус временного периода заявки 
         * @param type $id - ID позиции картриджа
         * @return type
         */
        public static function getCurTimeStatus($id)
        {
             $curTimeStatus=Yii::app()->db->createCommand("SELECT ctp.active FROM `cms_request` cr
                                                                   INNER JOIN `cms_time_period` ctp ON(ctp.`id`=cr.`id_time_period`)
                                                                   INNER JOIN `cms_request_position` crp on(crp.id_request=cr.id)
                                                           WHERE crp.`id`=$id AND
                                                                 cr.`deleted`='0'"
                                                       )->queryAll();
            
            return $curTimeStatus;
        }       
        
        /**
         * Получаю статус заявки
         * @param type $id - ID позиции заявки
         * @return type
         */
        public static function getCurStatus($id)
        {
             $curTimeStatus=Yii::app()->db->createCommand("SELECT cr.status FROM `cms_request` cr                                                                   
                                                                   INNER JOIN `cms_request_position` crp on(crp.id_request=cr.id)
                                                           WHERE crp.`id`=$id AND
                                                                 cr.`deleted`='0'"
                                                       )->queryAll();
            
            return $curTimeStatus;
        }       
        
        /**
         * Проверяю наличие существования картриджа в заявке
         * @param type $id_request - ID заявки
         * @param type $id_cartridge - ID картриджа
         * @param type $id_address - ID адреса
         * @return type
         */
        public static function checkPosition($id_request, $id_cartridge, $id_address)
        {            
            $position=Yii::app()->db->createCommand("SELECT crp.id, crp.`amount`
                                                     FROM `cms_request_position` crp
                                                     WHERE crp.`id_cartridge`='$id_cartridge' AND
                                                           crp.`deleted`='0' AND 
                                                           crp.`id_address`='$id_address' AND
                                                           crp.`id_request`='$id_request'"
                                                       )->queryAll();
            return $position;
        }        
        
        protected function beforeSave()
        {
            //Проставляю количество, если оно неверно указано в форме
            if($this->amount<0)
            {
                $this->amount=1;
            }           
            
            //Фиксирую цену картриджа
            $this->price=$this->cartridge->cartridge_price->price;
            
            return parent::beforeSave();
        }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RequestPosition the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}       
}
