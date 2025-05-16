<?php

use PhpParser\Node\Stmt\Label;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="form">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'car_id')->dropDownList($userCars, ['prompt' => 'Válassz autót'])->label('Autó kiválasztása') ?>

    <?= $form->field($model, 'type')->dropDownList([
        'fuel' => '⛽ Tankolás',
        'cost' => '💰 Költség',
        'repair' => '🛠 Javítás',
    ], ['prompt' => 'Válassz típust'])->label('Költés típusának kiválasztása') ?>
    <?= $form->field($model, 'title')->textInput(['maxlength' => true])->label('Költés megnevezése') ?>
    <?= $form->field($model, 'amount')->textInput(['type' => 'number', 'step' => '0.01'])->label('Költés összege (Ft)') ?>
    <?= $form->field($model, 'date')->textInput(['type' => 'date'])->label('Költés dátuma') ?>
    <?= $form->field($model, 'description')->textarea(['rows' => 3])->label('Megjegyzés') ?>

    <div class="form-group">
        <?= Html::submitButton('Mentés', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
