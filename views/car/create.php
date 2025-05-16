<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Új autó hozzáadása';
$this->params['breadcrumbs'][] = ['label' => 'Autóim', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="create">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="car-form">
        <?= $this->render('_form', ['model' => $model]) ?>
    </div>
</div>