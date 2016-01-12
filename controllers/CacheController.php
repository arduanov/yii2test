<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class CacheController extends Controller
{
    public function actionIndex()
    {
        $cache = Yii::$app->cache;
        $request = Yii::$app->request;
        $key = 'date';

        $flush = $request->get('flush-cache');

        if (!is_null($flush)) {
            $cache->delete($key);
        }

        $date = $cache->get($key);
        if ($date === false) {
            $date = date('Y-m-d H:i:s');
            $cache->set($key, $date);
        }

        return $this->render('index', [
            'date' => $date
        ]);
    }

}
