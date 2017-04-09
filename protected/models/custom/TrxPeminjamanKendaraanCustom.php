<?php

/**
 * Created by PhpStorm.
 * User: reals
 * Date: 3/12/2017
 * Time: 11:05 AM
 */
class TrxPeminjamanKendaraanCustom extends TrxPeminjamanKendaraan
{
    public $fileUpload;

    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        $defaultRule = parent::rules();
        $newRule = array(
            array('kendaraan_id, peminjam, nodin, waktu_mulai, waktu_selesai, no_polisi', 'required')  ,
//            array('MIN_REQUEST','numerical','integerOnly'=>true,'min'=>1,'max'=>9999999),
            //array('MAX_REQUEST','notLessThanMin')
        );

        return array_merge($defaultRule, $newRule);
    }

    public function listPermohonan()
    {
        $criteria = new CDbCriteria;
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort'=>array(
                'defaultOrder'=>'id asc'
            )
        ));
    }

    public function listPeminjaman() {
        $criteria = new CDbCriteria;
        $criteria->compare('status',array(0,1));
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort'=>array(
                'defaultOrder'=>'id asc'
            )
        ));
    }

    public function simpan($param) {
        $this->attributes = $param;
        $this->waktu_mulai = new CDbExpression("TO_TIMESTAMP(:mulai,'DD-MM-YYYY hh24:mi')", array(":mulai"=>$this->waktu_mulai));
        $this->waktu_selesai = new CDbExpression("TO_TIMESTAMP(:selesai,'DD-MM-YYYY hh24:mi')", array(":selesai"=>$this->waktu_selesai));
        $this->status = StatusPeminjaman::MENUNGGU_PERSETUJUAN;
        $this->kendaraan_id = intval($this->kendaraan_id);
        if($this->nodin != '') {
            $file = CUploadedFile::getInstance($this,'nodin');
            $file->saveAs(Yii::app()->basePath . '/data/nodin_kendaraan/'.$file->name);
            $this->nodin = $file->name;
        }
        if($this->validate())
            $this->save();
//            if ($model->save()) {
//                if($save_file){
//                    $model->file->saveAs($model->logo);
//                }
//                return $this->redirect([‘view’, ‘id’ => $model->id]);
//            }
//        }
    }
}