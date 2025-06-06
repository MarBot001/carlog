<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

class SiteController extends Controller
{
    public function actions()
{
    return [
        'error' => [
            'class' => 'yii\web\ErrorAction',
        ],
    ];
}

    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['auth/login']);
        } else {
            return $this->redirect(['expense/index']);
        }
    }
}
