<?php

/**
 * This is the model class for table "trx_peminjaman_kendaraan".
 *
 * The followings are the available columns in table 'trx_peminjaman_kendaraan':
 * @property integer $id
 * @property integer $kendaraan_id
 * @property boolean $ketersediaan
 * @property string $peminjam
 * @property string $kegiatan
 * @property string $supir
 * @property integer $status
 * @property string $waktu_mulai
 * @property string $waktu_selesai
 * @property string $no_polisi
 * @property string $nodin
 *
 * The followings are the available model relations:
 * @property MstKendaraan $kendaraan
 */
class TrxPeminjamanKendaraan extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'trx_peminjaman_kendaraan';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('kendaraan_id, status', 'numerical', 'integerOnly'=>true),
			array('peminjam, supir', 'length', 'max'=>250),
			array('no_polisi', 'length', 'max'=>15),
			array('ketersediaan, kegiatan, waktu_mulai, waktu_selesai, nodin', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, kendaraan_id, ketersediaan, peminjam, kegiatan, supir, status, waktu_mulai, waktu_selesai, no_polisi, nodin', 'safe', 'on'=>'search'),
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
			'kendaraan' => array(self::BELONGS_TO, 'MstKendaraan', 'kendaraan_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'kendaraan_id' => 'Kendaraan',
			'ketersediaan' => 'Ketersediaan',
			'peminjam' => 'Peminjam',
			'kegiatan' => 'Kegiatan',
			'supir' => 'Supir',
			'status' => 'Status',
			'waktu_mulai' => 'Waktu Mulai',
			'waktu_selesai' => 'Waktu Selesai',
			'no_polisi' => 'No Polisi',
			'nodin' => 'Nodin',
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
		$criteria->compare('kendaraan_id',$this->kendaraan_id);
		$criteria->compare('ketersediaan',$this->ketersediaan);
		$criteria->compare('peminjam',$this->peminjam,true);
		$criteria->compare('kegiatan',$this->kegiatan,true);
		$criteria->compare('supir',$this->supir,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('waktu_mulai',$this->waktu_mulai,true);
		$criteria->compare('waktu_selesai',$this->waktu_selesai,true);
		$criteria->compare('no_polisi',$this->no_polisi,true);
		$criteria->compare('nodin',$this->nodin,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TrxPeminjamanKendaraan the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
