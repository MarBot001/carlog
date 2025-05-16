<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use app\models\Expense;
use app\models\Car;

class ExpenseController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index', 'create'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

public function actionIndex()
{
    $carId = Yii::$app->request->get('car_id');

    $query = Expense::find()
        ->joinWith('car')
        ->where(['car.user_id' => Yii::$app->user->id])
        ->orderBy(['date' => SORT_DESC]);

    if (!empty($carId)) {
        $query->andWhere(['car_id' => $carId]);
    }

    $totalAmount = (clone $query)->sum('amount');

    $expenses = $query->all();

    $userCars = ArrayHelper::map(
        Car::find()->where(['user_id' => Yii::$app->user->id])->all(),
        'id',
        function ($car) {
            return "{$car->brand} {$car->model} {$car->edition}";
        }
    );

    return $this->render('index', [
        'expenses' => $expenses,
        'userCars' => $userCars,
        'selectedCarId' => $carId,
        'totalAmount' => $totalAmount,
    ]);
}



    public function actionCreate()
    {
        $model = new Expense();

        $userCars = Car::find()
            ->where(['user_id' => Yii::$app->user->id])
            ->all();

        $userCars = ArrayHelper::map(
            $userCars,
            'id',
            function ($car) {
                return "{$car->brand} {$car->model} {$car->edition}";
            }
        );

        if ($model->load(Yii::$app->request->post())) {
            switch ($model->type) {
                case 'fuel':
                    $model->icon = 'bi-fuel-pump';
                    break;
                case 'cost':
                    $model->icon = 'bi-cash';
                    break;
                case 'repair':
                    $model->icon = 'bi-tools';
                    break;
            }

            if ($model->save()) {
                return $this->redirect(['index']);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'userCars' => $userCars,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        // csak saját autóhoz tartozó költést engedjen szerkeszteni
        if ($model->car->user_id !== Yii::$app->user->id) {
            throw new \yii\web\ForbiddenHttpException('Nincs jogosultságod módosítani ezt a költést.');
        }
        $userCars = Car::find()
            ->where(['user_id' => Yii::$app->user->id])
            ->all();

        $userCars = ArrayHelper::map(
            $userCars,
            'id',
            function ($car) {
                return "{$car->brand} {$car->model} {$car->edition}";
            }
        );
        if ($model->load(Yii::$app->request->post())) {
            switch ($model->type) {
                case 'fuel':
                    $model->icon = 'bi-fuel-pump';
                    break;
                case 'cost':
                    $model->icon = 'bi-cash';
                    break;
                case 'repair':
                    $model->icon = 'bi-tools';
                    break;
            }

            if ($model->save()) {
                return $this->redirect(['index']);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'userCars' => $userCars,
        ]);
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if ($model->car->user_id !== Yii::$app->user->id) {
            throw new \yii\web\ForbiddenHttpException('Nincs jogosultságod törölni ezt a költést.');
        }

        $model->delete();
        return $this->redirect(['index']);
    }


    protected function findModel($id)
    {
        $model = Expense::find()->joinWith('car')->where([
            'expense.id' => $id,
            'car.user_id' => Yii::$app->user->id,
        ])->one();

        if (!$model) {
            throw new NotFoundHttpException('A megadott költés nem található vagy nincs jogosultságod.');
        }

        return $model;
    }
}
