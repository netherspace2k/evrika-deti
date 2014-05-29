<?php

/**
 * This is the model class for table "orders".
 *
 * The followings are the available columns in table 'orders':
 * @property integer $id
 * @property string $fio
 * @property string $phone
 * @property string $email
 * @property string $playpen_type
 * @property integer $count
 * @property string $deliver_type
 * @property string $payment_type
 * @property string $city
 * @property string $index
 * @property string $street
 * @property string $house
 * @property string $office
 * @property string $page
 * @property string $comment
 * @property integer $pillow
 * @property integer $status_id
 */
class Orders extends CActiveRecord
{
    const COST_ADMIN = 1000;
    const COST_PARTNER = 1300;
    
    //public $costOrder;  //стоимость заказа
    //public $costDelivery;  //стоимость доставки
    //public $costSummary;  //стоимость всего
    
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'orders';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('fio, phone, email, playpen_type, count, deliver_type, payment_type, city, index, street, house, office, page', 'required'),
			array('count, pillow, status_id', 'numerical', 'integerOnly'=>true),
			array('fio, playpen_type, deliver_type, payment_type, city, index, street, page', 'length', 'max'=>255),
			array('phone', 'length', 'max'=>16),
			array('email, house, office', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
            array('id, fio, phone, email, playpen_type, count, deliver_type, payment_type, city, index, street, house, office, page, comment, pillow, status_id', 'safe', 'on'=>'search'),
			array('fio, phone, email, playpen_type, count, deliver_type, payment_type, city, index, street, house, office, page, comment, pillow, status_id, costOrder, costDelivery, costSummary, delivery_id', 'safe'),
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
			'status' => array(self::BELONGS_TO, 'Statuses', 'status_id'),
	    );
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'fio' => 'ФИО',
			'phone' => 'Телефон',
			'email' => 'e-mail',
			'playpen_type' => 'Тип манежа',
			'count' => 'Количество',
			'deliver_type' => 'Способ доставки',
			'payment_type' => 'Способ оплаты',
			'city' => 'Город',
			'index' => 'Индекс',
			'street' => 'Улица',
			'house' => 'Дом',
			'office' => 'Квартира',
			'page' => 'Источник',
			'comment' => 'Комментарий',
			'pillow' => 'Подушки',
			'status_id' => 'Статус заказа',
            'costOrder' => 'Стоимость товара',  //стоимость заказа
            'costDelivery' => 'Стоимость доставки',  //стоимость доставки
            'costSummary' => 'Общая стоимость',  //стоимость всего
            'delivery_id' => 'ID доставки',  //стоимость всего
		);
	}

    /**
    * скоупы
    * 
    */
    public function scopes() {
        return array(
            'new' => array(
                'condition' => $this->getTableAlias() . '.status_id IS NULL',
            ),
            'partner' => array(
                'condition' => $this->getTableAlias() . '.page = :partner',
                'params' => array(':partner'=>Yii::app()->user->id),
            ),
        );
    }
    
    /**
    * скоуп по умолчанию
    * 
    */
    public function defaultscope() {//DebugBreak();
        if (Yii::app()->user->role == "partner") 
        {
            //$scopes = $this->scopes();
            //$arr = $scopes['partner'];
            $arr = array(
                'condition' => 'page = :partner',
                'params' => array(':partner'=>Yii::app()->user->id),
            );
        } else {
            $arr = array();
        }
        return $arr;
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
		$criteria->compare('fio',$this->fio,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('playpen_type',$this->playpen_type,true);
		$criteria->compare('count',$this->count);
		$criteria->compare('deliver_type',$this->deliver_type,true);
		$criteria->compare('payment_type',$this->payment_type,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('index',$this->index,true);
		$criteria->compare('street',$this->street,true);
		$criteria->compare('house',$this->house,true);
		$criteria->compare('office',$this->office,true);
		$criteria->compare('page',$this->page,true);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('pillow',$this->pillow);
		$criteria->compare('status_id',$this->status_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Orders the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function getUrl()
	{
		return Yii::app()->createUrl(
			'site/view', 
			array(
				'id'=>$this->id,
				//'title'=>$this->title,
			)
		);
	}
	
	//выборка всех разделов с количеством
	public function StatusCount()
	{
		$statusMenuList = array();
		$statuses = Statuses::model()->with('orderCount')->findAll();
		foreach($statuses as $item) {
  			$statusMenuList [$item->id] = $item->status_name . '(' . $item->orderCount . ')';
  		}
  		return $statusMenuList;
	}
    
    //процедура при выборке записи из базы (можно инитить или менять значения полей)
   /* public function afterFind() {
        if (empty($this->count))
            $this->count = 0;
        if (!isset($this->costOrder)) { //проверяем тип товара
            if ($this->playpen_type == '0-3')
                $this->costOrder = 2000;     //ставим цену
            else if ($this->playpen_type == '3+')
                $this->costOrder = 1900;
            else
                $this->costOrder = 0;
            //умножаем на кол-во
            $this->costOrder = $this->costOrder * $this->count;
            //добавляем подушку ))
            if ($this->pillow) 
                $this->costOrder = $this->costOrder + 600;
        }
        if (!isset($this->costDelivery)) {
            if ($this->count >= 2)
                $this->costDelivery = 0;
            else
                $this->costDelivery = 350;
        }
        $this->costSummary = $this->costOrder+ $this->costDelivery;
    }*/
    
}
