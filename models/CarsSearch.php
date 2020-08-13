<?php
/**
 * Created by PhpStorm.
 * User: kelor
 * Date: 13.08.2020
 * Time: 3:53
 */

namespace app\models;

use yii;
use yii\data\ActiveDataProvider;

class CarsSearch extends ActiveDataProvider
{
    private $per_page = 10;

    public function search()
    {
        /*
         *  правила в конфиге для ссылок вида:
         * catalog/Lexus
         * catalog/Lexus/ES
         * :
         * [
                'pattern' => 'catalog/<brand:[a-zA-Z\-\d]+>',
                'route' => 'cars/list',
            ],
            [
                'pattern' => 'catalog/<brand:[a-zA-Z\-\d]+>/<model:[a-zA-Z\-\d]+>',
                'route' => 'cars/list',
            ],
         */
        $request = Yii::$app->request;
        $params = [];

        foreach(Cars::mapping() as $key => $field) {
            if ($request->get($key) != null) {
                if (is_array($field)) {
                    if (isset($field[1][$request->get($key)]))  {
                         $params[$field[0]] = $field[1][$request->get($key)];
                    }
                } else {
                    $params[$field] = $request->get($key);
                }
            }
        }

        $query = Cars::find()->where($params);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => $this->per_page,
            ],
            'sort' => [
                'defaultOrder' => [
                    'model' => SORT_ASC, //и это м.б. из реквеста
                ]
            ], 
        ]);


        return ['count' => $dataProvider->getCount(), 'total' => $dataProvider->getTotalCount(), 'rows' => $dataProvider->getModels()];
    }

}