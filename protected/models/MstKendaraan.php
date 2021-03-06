<?php

/**
 * This is the model class for table "mst_kendaraan".
 *
 * The followings are the available columns in table 'mst_kendaraan':
 * @property integer $id
 * @property string $nama
 * @property string $no_polisi
 * @property string $keterangan
 * @property boolean $ketersediaan
 *
 * The followings are the available model relations:
 * @property TrxPeminjamanKendaraan[] $trxPeminjamanKendaraans
 */
class MstKendaraan extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'mst_kendaraan';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nama', 'length', 'max'=>50),
			array('no_polisi, keterangan, ketersediaan', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nama, no_polisi, keterangan, ketersediaan', 'safe', 'on'=>'search'),
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
			'trxPeminjamanKendaraans' => array(self::HAS_MANY, 'TrxPeminjamanKendaraan', 'kendaraan_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nama' => 'Nama',
			'no_polisi' => 'No Polisi',
			'keterangan' => 'Keterangan',
			'ketersediaan' => 'Ketersediaan',
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
		$criteria->compare('nama',$this->nama,true);
		$criteria->compare('no_polisi',$this->no_polisi,true);
		$criteria->compare('keterangan',$this->keterangan,true);
		$criteria->compare('ketersediaan',$this->ketersediaan);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MstKendaraan the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
