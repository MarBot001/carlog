<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var yii\web\HttpException|Exception $exception */
/** @var string $message */

$this->title = 'Hiba történt';
?>

<div class="site-error">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>Hiba történt a feldolgozás során.</p>
    <p>Kérlek, próbáld újra később.</p>
</div>
