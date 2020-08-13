<?php
/**
 * Created by PhpStorm.
 * User: kelor
 * Date: 13.08.2020
 * Time: 3:50
 */

namespace app\models;

use yii\db\ActiveRecord;

class Cars extends ActiveRecord
{
    public static function tableName()
    {
        return 'cars';
    }

    /**
     * @return \yii\db\Connection
     */
    public static function getDb()
    {
        return \Yii::$app->db;
    }

    public static function mapping(){
        return [
            'id' => 'id',
            'brand' => 'brand',
            'model' => 'model',
            'engine' => ['engine_id', ['benzin' => 1, 'dizel' => 2]], // по-хорошему, это надо не через маппинг, а хранить в базе справочник
            'drive' => 'drive_id'  // ну и это тоже
        ];
    }

}