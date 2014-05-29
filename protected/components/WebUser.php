<?php

class WebUser extends CWebUser
{

    /**
     * @var boolean whether to enable cookie-based login. Defaults to false.
     */
    public $allowAutoLogin=true;
    /**
     * @var string|array the URL for login. If using array, the first element should be
     * the route to the login action, and the rest name-value pairs are GET parameters
     * to construct the login URL (e.g. array('/site/login')). If this property is null,
     * a 403 HTTP exception will be raised instead.
     * @see CController::createUrl
     */
    public $loginUrl=array('/site/login');

    private $_identity;
    
    public function getRole()
    {
        return $this->getState('__role');
    }
    
    public function getId()
    {
        return $this->getState('__id') ? $this->getState('__id') : 0;
    }

//    protected function beforeLogin($id, $states, $fromCookie)
//    {
//        parent::beforeLogin($id, $states, $fromCookie);
//
//        $model = new UserLoginStats();
//        $model->attributes = array(
//            'user_id' => $id,
//            'ip' => ip2long(Yii::app()->request->getUserHostAddress())
//        );
//        $model->save();
//
//        return true;
//    }


    public function login($identity, $duration = 0)
    {
        $this->_identity = $identity;
        return parent::login($identity, $duration);
    }

    protected function afterLogin($fromCookie)
	{
        parent::afterLogin($fromCookie);
        if ($this->_identity->superuser)
            $this->setState('__role', 'admin');
        else
            $this->setState('__role', 'partner');
        
        //$this->updateSession();
	}

    /*public function updateSession() {
        if ($user = Yii::app()->getModule('user')->user($this->id)) {
            $this->name = $user->username;
            $userAttributes = CMap::mergeArray(array(
                                                    'email'=>$user->email,
                                                    'username'=>$user->username,
                                                    'create_at'=>$user->create_at,
                                                    'lastvisit_at'=>$user->lastvisit_at,
                                               ),$user->profile->getAttributes());
            foreach ($userAttributes as $attrName=>$attrValue) {
                $this->setState($attrName,$attrValue);
            }
        }
    }*/

    /*public function model($id=0) {
        return Yii::app()->getModule('user')->user($id);
    }*/

    /*public function user($id=0) {
        return $this->model($id);
    }

    */
    
    /**
    * является ли юзер админом
    */
    public function getIsAdmin() {
        return ($this->role == "admin");
    }
    
    /**
    * является ли юзер админом
    */
    public function getIsPartner() {
        return ($this->role == "partner");
    }
}