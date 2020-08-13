<?php
/**
 * Created by PhpStorm.
 * User: kelor
 * Date: 13.08.2020
 * Time: 4:06
 */

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\CarsSearch;


class CarsController extends Controller
{
    public function actionList()
    {

        $cars = new CarsSearch();
        $rows = $cars->search();

        return $this->render('cars_list', [
            'rows' => $rows
        ]);
    }
}