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
			'page' => 'Page',
			'comment' => 'Комментарий',
			'pillow' => 'Подушки',
			
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
	
	
	public function StatusCount()
	{
		/*
		$statusCount=array();
		$statuses=Statuses::model->findAll();
		foreach ($statuses as $status)
		{
			$criteria=new CDbCriteria(
				'condition'=>'status='.$status->id,
			);
			$statusCount[$status->id] = $this->count($criteria);
		}
		return  $statusCount;
		*/
		
		$statusMenuList = array();
		$statuses = Statuses::model()->with('orderCount')->findAll();
		foreach($statuses as $item) 
		{
  			//echo $item->status_name . '(' . $item->orderCount . ')';
  			$statusMenuList [$item->id] = $item->status_name . '(' . $item->orderCount . ')';
  		}
  		return $statusMenuList;
  		//return $statuses;
	}
}