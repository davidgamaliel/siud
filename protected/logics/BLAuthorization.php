<?php

/**
 * BLAuthorization
 *
 * Class untuk menghandle business logic yang berkenaan dengan otentikasi dan otorisasi
 * @author Zaki Rahman <zaki@pusilkom.ui.ac.id>
 * @package model
 * @version 1.0
 */
class BLAuthorization {

    private $password_iteration = 50;
    private $subtree = array();

    /**
     * authorize a user with his/her password
     * @param string the username to be authorized
     * @param string the password to be authorized
     */
    public function authorize($username, $password) {
        $model = new User;
        $user = User::model()->findByAttributes(array('username'=>$username, 'password'=>$password));
        if($user) {
            Yii::app()->user->setState('user_name', $user->username);
            Yii::app()->user->setState('user_id', $user->id);
            return CUserIdentity::ERROR_NONE;
        }
        else {
            return CUserIdentity::ERROR_PASSWORD_INVALID;
        }
    }
        
}

?>