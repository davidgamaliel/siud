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
        $ecrPass = $password;
        $user = TmstUser::model()->findByAttributes(array('username'=>$username, 'password'=>$ecrPass));
        //$roleUser = TrefRole::model()->findByPk($user->id_role);
        if($user) {
            $roleUser = TrefRole::model()->findByPk($user->id_role);
            Yii::app()->user->setState('user_name', $user->username);
            Yii::app()->user->setState('user_id', $user->id);
            Yii::app()->user->setState('role_id', $roleUser->id);
            Yii::app()->user->setState('role_name', $roleUser->nama);
            return CUserIdentity::ERROR_NONE;
        }
        else {
            return CUserIdentity::ERROR_PASSWORD_INVALID;
        }
    }

    public static function isAdmin() {
        $role = TrefRole::model()->findByAttributes(array('nama'=>'admin'));
        if(Yii::app()->user->hasState('role_id') && Yii::app()->user->getState('role_id') == $role->id)
            return true;
        else
            return false;
    }

    public static function isPegawai() {
        $role = TrefRole::model()->findByAttributes(array('nama'=>'pegawai'));
        if(Yii::app()->user->hasState('role_id') && Yii::app()->user->getState('role_id') == $role->id)
            return true;
        else
            return false;
    }

    public static function checkUser($username) {
        $rolePegawai = TrefRole::model()->findByAttributes(array('nama'=>'pegawai'));
        $exist = TmstUser::model()->findByAttributes(array('username'=>$username));
        if(!$exist) {
            $user = new TmstUser();
            $user->username = $username;
            $user->password = md5('!!!!!!!!!!!');
            $user->id_role = $rolePegawai->id;
            $user->email = 'tes@email.com';

            if($user->validate()) {
                $user->save();
            }
            $exist = $user;
        }
        Yii::app()->user->setState('user_name', $exist->username);
        Yii::app()->user->setState('user_id', $exist->id);
        Yii::app()->user->setState('role_id', $rolePegawai->id);
        Yii::app()->user->setState('role_name', $rolePegawai->nama);
    }
}

?>