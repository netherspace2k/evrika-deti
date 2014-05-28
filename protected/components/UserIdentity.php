<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
    private $_superuser = false;
    
    public function getSuperuser() {
        return $this->_superuser;
    }
    
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$users1 = Yii::app()->db->createCommand()
            ->select('*')
            ->from('users')
            ->queryAll();
        $users = array();
        foreach($users1 as $user) {
            $users[$user['username']] = $user['password'];
            $superuser[$user['username']] = $user['superuser'];
        }
        /*$users = array(// username => password
			    'admin'=>'admin',
		    );*/
		if(!isset($users[$this->username]))
			$this->errorCode = self::ERROR_USERNAME_INVALID;
		elseif($users[$this->username]!==$this->password)
			$this->errorCode = self::ERROR_PASSWORD_INVALID;
		else {
			$this->errorCode = self::ERROR_NONE;
            $this->_superuser = $superuser[$users[$this->username]];
        }
		return !$this->errorCode;
	}
}