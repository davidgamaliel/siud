<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	private $_fields = array("samaccountname","mail","memberof","department","displayname","telephonenumber","primarygroupid","objectsid");

	public function authenticate()
	{
		$users=array(
			// username => password
			'demo'=>'demo',
			'admin'=>'admin',
		);
		/*if(!isset($users[$this->username]))
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		elseif($users[$this->username]!==$this->password)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
			$this->errorCode=self::ERROR_NONE;
		return !$this->errorCode;*/

		$auth = new BLAuthorization();
		$this->errorCode = $auth->authorize($this->username, $this->password);
		if($this->errorCode == CUserIdentity::ERROR_NONE) {
			return !$this->errorCode;
		}

		// alter search fields if needed
	    // if(isset(Yii::app()->params['adFields'])) $this->_fields = Yii::app()->params['adFields'];
	    
	    if (Yii::app()->ldap->authenticate($this->username, $this->password)){
			$this->errorCode = self::ERROR_NONE;
			
			// collect AD info about users
			$info = Yii::app()->ldap->user()->infoCollection($this->username, $this->_fields);
			$testinfo = Yii::app()->ldap->user()->info($this->username);
			$groups = Yii::app()->ldap->user()->groups($this->username);
			
			if($testinfo) {
				$nuUser = $testinfo[0]["samaccountname"][0];
				$this->errorCode = BLAuthorization::checkUser($nuuser);
			}
			
			// $groups = Yii::app()->ldap->user()->groups($this->username);
			
			// export ad info to user session
			// foreach($this->_fields as $field)
			// 	$this->setState($field, $info->$field);	
			
			// export groups array
			// $this->setState('groups', $groups);
		} else {
			$this->errorCode = self::ERROR_PASSWORD_INVALID;
		}

		return !$this->errorCode;
	}
}