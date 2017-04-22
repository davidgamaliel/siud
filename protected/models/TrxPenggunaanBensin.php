<?php

/**
 * This is the model class for table "trx_penggunaan_bensin".
 *
 * The followings are the available columns in table 'trx_penggunaan_bensin':
 * @property integer $id
 * @property string $unit_kerja
 * @property string $keperluan
 * @property string $file_struk
 * @property string $jumlah_bensin
 */
class TrxPenggunaanBensin extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'trx_penggunaan_bensin';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('unit_kerja, keperluan, file_struk, jumlah_bensin', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, unit_kerja, keperluan, file_struk, jumlah_bensin', 'safe', 'on'=>'search'),
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
			'idPemohon' => array(self::BELONGS_TO, 'TmstUser', 'id_pemohon'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'unit_kerja' => 'Unit Kerja',
			'keperluan' => 'Keperluan',
			'file_struk' => 'File Struk',
			'jumlah_bensin' => 'Jumlah Bensin',
			'id_pemohon' => 'Pemohon',
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
		$criteria->compare('unit_kerja',$this->unit_kerja,true);
		$criteria->compare('keperluan',$this->keperluan,true);
		$criteria->compare('file_struk',$this->file_struk,true);
		$criteria->compare('jumlah_bensin',$this->jumlah_bensin,true);
		$criteria->compare('id_pemohon',$this->id_pemohon,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TrxPenggunaanBensin the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
