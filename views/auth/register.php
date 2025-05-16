<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Regisztráció';
?>

<div class="site-register">
    <h1><?= Html::encode($this->title) ?></h1>


    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name')->textInput()->label('Teljes név') ?>
        <?= $form->field($model, 'email')->textInput()->label('Email cím') ?>
        <?= $form->field($model, 'password')->passwordInput()->label('Jelszó') ?>
        <?= $form->field($model, 'password_repeat')->passwordInput()->label('Jelszó újra!') ?>

        <div class="form-group">
            <?= Html::submitButton('Regisztráció', ['class' => 'btn btn-success']) ?>
            <?= Html::a('Már van fiókod? Jelentkezz be', ['login'], ['class' => 'btn btn-link']) ?>
        </div>

    <?php ActiveForm::end(); ?>
</div>
