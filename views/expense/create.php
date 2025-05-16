<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Költés kezelése';
$this->params['breadcrumbs'][] = ['label' => 'Költések', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="create">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="expense-form">

        <?= $this->render('_form', [
            'model' => $model,
            'userCars' => $userCars,
        ]) ?>

    </div>
</div>