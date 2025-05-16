<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Bejelentkezés';
?>

<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'email')->textInput(['autofocus' => true])->label('Email cím') ?>
        <?= $form->field($model, 'password')->passwordInput()->label('Jelszó') ?>
        <?= $form->field($model, 'rememberMe')->checkbox() ?>
        
        <div class="form-group">
            <?= Html::submitButton('Bejelentkezés', ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Nincs még fiókod? Regisztrálj!', ['register'], ['class' => 'btn btn-link']) ?>
        </div>

    <?php ActiveForm::end(); ?>
</div>
