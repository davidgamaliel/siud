<?php

/**
 * This is the model class for table "tmst_user".
 *
 * The followings are the available columns in table 'tmst_user':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property integer $id_role
 * @property integer $id_pegawai
 * @property string $email
 *
 * The followings are the available model relations:
 * @property TrefRole $idRole
 * @property TranPeminjamanRuangan[] $tranPeminjamanRuangans
 */
class TmstUser extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tmst_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_role, id_pegawai', 'numerical', 'integerOnly'=>true),
			array('username, password', 'length', 'max'=>25),
			array('email', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, username, password, id_role, id_pegawai, email', 'safe', 'on'=>'search'),
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
			'idRole' => array(self::BELONGS_TO, 'TrefRole', 'id_role'),
			'tranPeminjamanRuangans' => array(self::HAS_MANY, 'TranPeminjamanRuangan', 'id_user_peminjam'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Username',
			'password' => 'Password',
			'id_role' => 'Id Role',
			'id_pegawai' => 'Id Pegawai',
			'email' => 'Email',
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
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('id_role',$this->id_role);
		$criteria->compare('id_pegawai',$this->id_pegawai);
		$criteria->compare('email',$this->email,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TmstUser the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
