<?php

/**
 * This is the model class for table "tran_peminjaman_ruangan".
 *
 * The followings are the available columns in table 'tran_peminjaman_ruangan':
 * @property integer $id
 * @property integer $id_ruangan
 * @property integer $id_user_peminjam
 * @property string $tanggal_peminjaman
 * @property string $waktu_awal_peminjaman
 * @property string $kegiatan
 * @property string $nodin
 * @property string $waktu_akhir_peminjaman
 *
 * The followings are the available model relations:
 * @property TmstUser $idUserPeminjam
 * @property TmstRuangan $idRuangan
 */
class TranPeminjamanRuangan extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tran_peminjaman_ruangan';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_ruangan, waktu_awal_peminjaman, waktu_akhir_peminjaman, kegiatan, tanggal_peminjaman', 'required'),
			array('id_ruangan, id_user_peminjam', 'numerical', 'integerOnly'=>true),
			array('waktu_awal_peminjaman, waktu_akhir_peminjaman', 'length', 'max'=>20),
			array('kegiatan', 'length', 'max'=>100),
			array('nodin', 'file', 'types'=>'jpg, png', 'safe'=>false, 'allowEmpty'=>true),
			array('tanggal_peminjaman', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_ruangan, id_user_peminjam, tanggal_peminjaman, waktu_awal_peminjaman, kegiatan, nodin, waktu_akhir_peminjaman', 'safe', 'on'=>'search'),
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
			'idUserPeminjam' => array(self::BELONGS_TO, 'TmstUser', 'id_user_peminjam'),
			'idRuangan' => array(self::BELONGS_TO, 'TmstRuangan', 'id_ruangan'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_ruangan' => 'Ruangan',
			'id_user_peminjam' => 'User Peminjam',
			'tanggal_peminjaman' => 'Tanggal Peminjaman',
			'waktu_awal_peminjaman' => 'Waktu Awal',
			'kegiatan' => 'Kegiatan',
			'nodin' => 'Nodin',
			'waktu_akhir_peminjaman' => 'Waktu Akhir',
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
		$criteria->compare('id_ruangan',$this->id_ruangan);
		$criteria->compare('id_user_peminjam',$this->id_user_peminjam);
		$criteria->compare('tanggal_peminjaman',$this->tanggal_peminjaman,true);
		$criteria->compare('waktu_awal_peminjaman',$this->waktu_awal_peminjaman,true);
		$criteria->compare('kegiatan',$this->kegiatan,true);
		$criteria->compare('nodin',$this->nodin,true);
		$criteria->compare('waktu_akhir_peminjaman',$this->waktu_akhir_peminjaman,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TranPeminjamanRuangan the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
