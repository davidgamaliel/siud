<?php

/**
 * This is the model class for table "tran_perbaikan_inventaris".
 *
 * The followings are the available columns in table 'tran_perbaikan_inventaris':
 * @property integer $id
 * @property integer $user_id
 * @property integer $inventaris_id
 * @property string $tanggal_laporan
 * @property string $deskripsi
 * @property string $divisi
 * @property integer $jumlah
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property TmstUser $user
 * @property TmstInventaris $inventaris
 * @property TrefStatusPermohonan $status0
 */
class TranPerbaikanInventaris extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tran_perbaikan_inventaris';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, inventaris_id, jumlah, status', 'numerical', 'integerOnly'=>true),
			array('tanggal_laporan, deskripsi, divisi', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, inventaris_id, tanggal_laporan, deskripsi, divisi, jumlah, status', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'TmstUser', 'user_id'),
			'inventaris' => array(self::BELONGS_TO, 'TmstInventaris', 'inventaris_id'),
			'status0' => array(self::BELONGS_TO, 'TrefStatusPermohonan', 'status'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'inventaris_id' => 'Inventaris',
			'tanggal_laporan' => 'Tanggal Laporan',
			'deskripsi' => 'Deskripsi',
			'divisi' => 'Divisi',
			'jumlah' => 'Jumlah',
			'status' => 'Status',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('inventaris_id',$this->inventaris_id);
		$criteria->compare('tanggal_laporan',$this->tanggal_laporan,true);
		$criteria->compare('deskripsi',$this->deskripsi,true);
		$criteria->compare('divisi',$this->divisi,true);
		$criteria->compare('jumlah',$this->jumlah);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TranPerbaikanInventaris the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
