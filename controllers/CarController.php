<?php

namespace app\controllers;

use Yii;
use app\models\Car;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;

class CarController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index', 'view', 'create', 'update', 'delete'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'], // csak bejelentkezett felhasználók
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $cars = Car::find()->where(['user_id' => Yii::$app->user->id])->all();
        return $this->render('index', ['cars' => $cars]);
    }

    public function actionView($id)
    {
        $car = $this->findModel($id);
        return $this->render('view', ['model' => $car]);
    }

    public function actionCreate()
    {
        $model = new Car();
        $model->user_id = Yii::$app->user->id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->id]);
        }

        return $this->render('create', ['model' => $model]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->user_id !== Yii::$app->user->id) {
            throw new NotFoundHttpException('Nincs jogosultságod ehhez az autóhoz.');
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', ['model' => $model]);
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if ($model->user_id === Yii::$app->user->id) {
            $model->delete();
        }

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        $model = Car::findOne($id);
        if (!$model || $model->user_id !== Yii::$app->user->id) {
            throw new NotFoundHttpException('A kért autó nem található.');
        }
        return $model;
    }
}
