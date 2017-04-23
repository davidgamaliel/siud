<?php

/**
 * This is the model class for table "trx_peminjaman_kendaraan".
 *
 * The followings are the available columns in table 'trx_peminjaman_kendaraan':
 * @property integer $id
 * @property integer $kendaraan_id
 * @property string $peminjam
 * @property string $kegiatan
 * @property string $supir
 * @property string $tanggal_peminjaman
 * @property string $waktu_peminjaman
 * @property string $nodin
 * @property integer $status
 * @property string $waktu_mulai
 * @property string $waktu_selesai
 * @property string $no_polisi
 * @property integer $id_peminjam
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
			array('kendaraan_id, status, id_peminjam', 'numerical', 'integerOnly'=>true),
			array('peminjam, kegiatan, supir', 'length', 'max'=>50),
			array('waktu_peminjaman', 'length', 'max'=>20),
			array('no_polisi', 'length', 'max'=>15),
			array('tanggal_peminjaman, nodin, waktu_mulai, waktu_selesai', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, kendaraan_id, peminjam, kegiatan, supir, tanggal_peminjaman, waktu_peminjaman, nodin, status, waktu_mulai, waktu_selesai, no_polisi, id_peminjam', 'safe', 'on'=>'search'),
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
			'peminjam' => 'Peminjam',
			'kegiatan' => 'Kegiatan',
			'supir' => 'Supir',
			'tanggal_peminjaman' => 'Tanggal Peminjaman',
			'waktu_peminjaman' => 'Waktu Peminjaman',
			'nodin' => 'Nodin',
			'status' => 'Status',
			'waktu_mulai' => 'Waktu Mulai',
			'waktu_selesai' => 'Waktu Selesai',
			'no_polisi' => 'No Polisi',
			'id_peminjam' => 'Id Peminjam',
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
		$criteria->compare('peminjam',$this->peminjam,true);
		$criteria->compare('kegiatan',$this->kegiatan,true);
		$criteria->compare('supir',$this->supir,true);
		$criteria->compare('tanggal_peminjaman',$this->tanggal_peminjaman,true);
		$criteria->compare('waktu_peminjaman',$this->waktu_peminjaman,true);
		$criteria->compare('nodin',$this->nodin,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('waktu_mulai',$this->waktu_mulai,true);
		$criteria->compare('waktu_selesai',$this->waktu_selesai,true);
		$criteria->compare('no_polisi',$this->no_polisi,true);
		$criteria->compare('id_peminjam',$this->id_peminjam);

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
