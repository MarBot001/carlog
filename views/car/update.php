<?php

use yii\helpers\Html;

$this->title = 'Autó szerkesztése';
$this->params['breadcrumbs'][] = ['label' => 'Autóim', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="update">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', ['model' => $model]) ?>
</div>
