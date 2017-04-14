<?php
/**
 * Created by PhpStorm.
 * User: zhaoyao
 * Date: 2017/4/5
 * Time: 17:44
 */
namespace frontend\models;

use Yii;
use yii\db\ActiveRecord;

class Acid_event extends ActiveRecord
{
    //public $verifyCode;

    public static function getDb()
    {
        return Yii::$app->alienvault_siem;
    }


    /*public static function tableName()
    {
        return 'members';
    }


    public function rules()
    {
        return [
            [['username', 'credit1', 'credit2'], 'required'],
        ];
    }


    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verification Code',
        ];
    }*/

}

