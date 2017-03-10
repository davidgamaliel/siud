<?php

/**
 * This is the model class for table "tmst_ruangan".
 *
 * The followings are the available columns in table 'tmst_ruangan':
 * @property integer $id
 * @property string $nama
 * @property string $lokasi
 * @property string $fasilitas
 * @property integer $kapasitas
 *
 * The followings are the available model relations:
 * @property TranPeminjamanRuangan[] $tranPeminjamanRuangans
 */
class TmstRuangan extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tmst_ruangan';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('kapasitas', 'numerical', 'integerOnly'=>true),
			array('nama, lokasi', 'length', 'max'=>50),
			array('fasilitas', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nama, lokasi, fasilitas, kapasitas', 'safe', 'on'=>'search'),
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
			'tranPeminjamanRuangans' => array(self::HAS_MANY, 'TranPeminjamanRuangan', 'id_ruangan'),
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
			'lokasi' => 'Lokasi',
			'fasilitas' => 'Fasilitas',
			'kapasitas' => 'Kapasitas',
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
		$criteria->compare('lokasi',$this->lokasi,true);
		$criteria->compare('fasilitas',$this->fasilitas,true);
		$criteria->compare('kapasitas',$this->kapasitas);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TmstRuangan the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
