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
 * @property integer $status_id
 *
 * The followings are the available model relations:
 * @property TmstRuangan $idRuangan
 * @property TmstUser $idUserPeminjam
 * @property TrefStatusPermohonan $status
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
			array('id_ruangan, waktu_awal_peminjaman, waktu_akhir_peminjaman, kegiatan, status_id', 'required', 'message'=>'{attribute} tidak boleh kosong'),
			array('id_ruangan, id_user_peminjam', 'numerical', 'integerOnly'=>true),
			array('kegiatan', 'length', 'max'=>100),
			array('nodin', 'file', 'types'=>'jpg, png, pdf', 'safe'=>false, 'allowEmpty'=>false),
			array('tanggal_peminjaman', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_ruangan, id_user_peminjam, tanggal_peminjaman, waktu_awal_peminjaman, kegiatan, nodin, waktu_akhir_peminjaman, status_id, keterangan', 'safe', 'on'=>'search'),
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
			'idRuangan' => array(self::BELONGS_TO, 'TmstRuangan', 'id_ruangan'),
			'idUserPeminjam' => array(self::BELONGS_TO, 'TmstUser', 'id_user_peminjam'),
			'status' => array(self::BELONGS_TO, 'TrefStatusPermohonan', 'status_id'),
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
			'id_user_peminjam' => 'Id User Peminjam',
			'tanggal_peminjaman' => 'Tanggal Peminjaman',
			'waktu_awal_peminjaman' => 'Waktu Awal Peminjaman',
			'kegiatan' => 'Kegiatan',
			'nodin' => 'Nodin',
			'waktu_akhir_peminjaman' => 'Waktu Akhir Peminjaman',
			'status_id' => 'Status',
			'keterangan' => 'Keterangan',
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
		$criteria->compare('status_id',$this->status_id);
		$criteria->compare('keterangan',$this->keterangan);

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

	public function getFormatedWaktuMulai() {
		$arrayBulan = array(
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4=> 'April',
            5 => 'Mei',
            6=> 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        );
        if(!is_null($this->waktu_awal_peminjaman) & !empty($this->waktu_awal_peminjaman)) {
            $temp = explode(' ',$this->waktu_awal_peminjaman);
            $tempTanggal = explode('-',$temp[0]);
            return ''. $tempTanggal[2] . ' ' . $arrayBulan[intval($tempTanggal[1])]  . ' ' . $tempTanggal[0]. ' '.$temp[1];
        }
        else {
            return '';
        }
	}

	public function getFormatedWaktuAkhir() {
		$arrayBulan = array(
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4=> 'April',
            5 => 'Mei',
            6=> 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        );
        if(!is_null($this->waktu_akhir_peminjaman) & !empty($this->waktu_akhir_peminjaman)) {
            $temp = explode(' ',$this->waktu_akhir_peminjaman);
            $tempTanggal = explode('-',$temp[0]);
            return ''. $tempTanggal[2] . ' ' . $arrayBulan[intval($tempTanggal[1])]  . ' ' . $tempTanggal[0]. ' '.$temp[1];
        }
        else {
            return '';
        }
	}
}
