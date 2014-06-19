<?php

class SiteController extends Controller
{
    private $_model;

    public function filters()
    {
        return array(
            'accessControl',
        );
    }

    public function accessRules()
    {
        return array(
            array('allow',
                'actions'=>array('login', 'logout'),
                //'users'=>array('*'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                //'actions'=>array('admin','delete'),
                //'actions'=>array('*'),
                'roles'=>array('admin'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                //'actions'=>array('admin','delete'),
                'actions'=>array('view', 'statistic', 'index'),
                'roles'=>array('partner'),
            ),
            // deny all users   
            array('deny',
                //'actions'=>array('*'),  
                'users'=>array('*'),
            ),
        );
    }
    
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

    /*public function beforeAction($action) {DebugBreak();
        $auth = Yii::app()->authManager;
        $auth->init();
        $yy = Yii::app()->user->checkAccess('update');
        return true;
    }*/
    
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
	
		$criteria = new CDbCriteria(array(
		));
		if (isset($_GET['status'])) {
			$criteria->addSearchCondition('status_id',$_GET['status']);
			$PageHeader = Statuses::model()->findByPk($_GET['status'])->status_name;
		} else  {
			$criteria->addCondition('status_id is null');
            $PageHeader='Новые заказы';
		}
		
		$dataProvider=new CActiveDataProvider('Orders', array(
			'pagination'=>array(
				'pageSize'=>20,
			),
			'criteria'=>$criteria,
		));
		
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
			'pageHeader'=>$PageHeader,
			//'postDayEnable'=>$postDayEnable,
		));
	}
	
	public function actionView($id)
	{
		$order=$this->loadModel($id);
		$model=new ContactForm;
		$model->email=$order->email;
		
		if(isset($_POST['ContactForm']))
		{//var_dump($_POST['ContactForm']);//Yii::app()->end();
			$model->attributes = $_POST['ContactForm'];
            $model->body = $_POST['ContactForm']["body"];
			if($model->validate())
			{//var_dump($model->body);Yii::app()->end();
				$charset = 'UTF-8';
				$name = '=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject = $model->subject;
				$headers = "\r\nFrom: " . Yii::app()->params['adminEmail'] . "\r\nReply-To: " . Yii::app()->params['adminEmail']. "\r\n". 
 						"Content-type: text/plain; charset={$charset}\r\n"; 
				mail($model->email, $subject, $model->body, $headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('view', array(
				'order'=>$order,
				'model'=>$model,
		));
	}
	
	public function actionUpdate($id)
	{
		$model=new Orders('update');
		$model=$this->loadModel($id);

	    // uncomment the following code to enable ajax-based validation
	    /* if(isset($_POST['ajax']) && $_POST['ajax']==='orders-update-form') {
	        echo CActiveForm::validate($model);
	        Yii::app()->end();
	    } */

	    if (isset($_POST['Orders'])) {
	        $model->attributes=$_POST['Orders'];
	        if($model->validate()) {
				if($model->save())
					$this->redirect(array('view','id'=>$model->id));
	        }
	    }
	    $this->render('update',array('model'=>$model));
	}
	
    //ДЕЙСТВИЕ: удаление 
    public function actionDelete($id)
    {
        if ($model = $this->loadModel($id))
            $model->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if(!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/command/index'));
    }  
    
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error) {
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model = new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	
	public function loadModel() //ID не нужен?
	{
		if ($this->_model === null) {
			if (isset($_GET['id'])) {
				/*
				if(Yii::app()->user->isGuest)
					$condition='status='.Post::STATUS_PUBLISHED
				  		.' OR status='.Post::STATUS_ARCHIVED;
				else
					$condition='';
				*/
				$this->_model = Orders::model()->findByPk($_GET['id']);
			}
			if ($this->_model === null)
				throw new CHttpException(404,'Запрашиваемая страница не существует.(loadModel)');
		}
		return $this->_model;
	}
	
    /**
    * смена статуса заказа
    * 
    * @param mixed $id
    */
    public function actionStatus($id) {
        $posted_statusid = Yii::app()->request->getParam('statusid');
        //if ($posted_statusid == 'undefined')
        //    $posted_statusid = null;
        //$type = isset($posted_type) ? $posted_type : $type;
        $success = Orders::model()->updateByPk($id, array('status_id'=>$posted_statusid));
        $success = $success ? 1 : 0;
        $request = Yii::app()->request;
        if ($request->isAjaxRequest) {
            $response = array('operation'=>'status', 'success'=>$success);
            //echo $model->errors;
            if (isset($error) && !empty($error)) {
                $response['error'] = $error;
            } else if (!empty($model->errors)) {
                $response['error'] = $model->errors;
            }
            echo CJSON::encode($response);
        } else {
            if (isset($request->urlReferrer) && $request->urlReferrer != $request->url)
                $this->redirect($request->urlReferrer);
            else
                $this->redirect($this->createUrl('users/view', array('id'=>$id)));
        }
    }
    
    /**
    * вывод статистики
    * 
    */
    public function actionStatistic() 
    {
        //количество
        $cmdAll = Yii::app()->db->createCommand()
            //->select(array('statuses.id', 'statuses.status_name', 'COUNT(*) as count'))
            ->select(array('statuses.id', 'statuses.status_name', 'sum(orders.count) as count'))
            ->from('orders')
            ->leftJoin('statuses', 'statuses.id = orders.status_id')
            ->where(array('in', 'status_id', array(2,4,5)))
            ->group('statuses.id, statuses.status_name');
        //если партнёр, добавить условие для выборки
        if (Yii::app()->user->isPartner) {
            $cmdAll->andWhere('page = :partner');
            $cmdAll->params = array(':partner'=>Yii::app()->user->name);
        }
        $dataAll = $cmdAll->queryAll();
        
        $cmdData = Yii::app()->db->createCommand()
            ->select(array('statuses.id', 'statuses.status_name', 'playpen_type', 'sum(orders.count) as count'))
            ->from('orders')
            ->leftJoin('statuses', 'statuses.id = orders.status_id')
            ->where('status_id = :status_id')
            ->group('statuses.id, statuses.status_name, playpen_type');
        //если партнёр, добавить условие для выборки
        if (Yii::app()->user->isPartner) {
            $cmdAll->andWhere('page = :partner');
            $cmdAll->params = array(':partner'=>Yii::app()->user->name);
        }
        
        $rawData = array();
        foreach($dataAll as $key=>$data) {
            $rawData[] = $data;
            $datas = $cmdData->queryAll(true, array('status_id'=>$data['id']));
            foreach($datas as $data) {
                $data['status_name'] = $data['playpen_type'];
                $rawData[] = $data;
            }
        }
        //
        $dataCount = new CArrayDataProvider($rawData, array(
            'keyField'=>false,
            'sort'=>array(
                'attributes'=>array(
                     'statuses.status_name',
                ),
            ),
        ));

        //наличие
        if (Yii::app()->user->isAdmin) {
            $rawAvailability = Yii::app()->db->createCommand()
                ->select(array('playpen_type', 'count - (select sum(orders.count) from orders where status_id in (4,5) and orders.playpen_type = products.playpen_type) as count'))
                ->from('products')
                ->union('select "Всего" as playpen_type, sum(count) - (select sum(orders.count) from orders where status_id in (4,5)) as count from products')
                ->queryAll();
            $dataAvailability = new CArrayDataProvider($rawAvailability, array(
                'keyField'=>false,
            ));
        }
        
        //баланс
        $criteria = New CDbCriteria();
        $criteria->addInCondition('status_id', array(2,4,5));
        $orders = Orders::model()->findAll($criteria);
        $rawBalance = array();
        $rawSecond = array();
        foreach($orders as $order) {
            $name = $order->status->status_name;
            if (!key_exists($name, $rawBalance)) 
                $rawBalance[$name] = 0;
            $rawBalance[$name] = $rawBalance[$name] + $order->costOrder;

            if (!key_exists($name, $rawSecond)) 
                $rawSecond[$name] = 0;
            $rawSecond[$name] = $rawSecond[$name] + $order->count * (Yii::app()->user->isPartner ? Orders::COST_PARTNER : Orders::COST_ADMIN);
        }
        $dataBalance = array();
        foreach($rawBalance as $key=>$value) {
            $dataBalance[] = array('status_name'=>$key, 'sum'=>$value . ' ('. ($value - $rawSecond[$key]) .')');
        }        
        $dataBalance = new CArrayDataProvider($dataBalance, array(
            'keyField'=>false,
        ));
        
        //рендер формы
        $this->render('stat', array(
            'dataCount'=>$dataCount,
            'dataBalance'=>$dataBalance,
            'dataAvailability'=>isset($dataAvailability) ? $dataAvailability : null,
        ));
    }
}