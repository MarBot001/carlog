<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\models\Car[] $cars */

$this->title = 'Autóim';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="car-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<i class="bi bi-car-front-fill"></i> Autó hozzáadása', ['create'], ['class' => 'btn btn-primary btn-float']) ?>
    </p>

    <ul class="list-group">
        <?php foreach ($cars as $car): ?>
            <li class="list-group-item">
                <strong><?= Html::encode("{$car->brand} {$car->model} {$car->edition}") ?></strong>
                – <?= Html::encode($car->year) ?>

                <span class="float-end">
                    <?= Html::a('<i class="bi bi-box-arrow-up-right"></i>', ['update', 'id' => $car->id], ['class' => 'btn btn-sm btn-outline-primary']) ?>
                    <?= Html::a('<i class="bi bi-trash"></i>', ['delete', 'id' => $car->id], [
                        'class' => 'btn btn-sm btn-outline-danger delete-car',
                        'data-id' => $car->id,
                        'data-url' => Url::to(['delete', 'id' => $car->id]),
                    ]) ?>


                </span>
            </li>
        <?php endforeach; ?>
    </ul>

</div>


<?php
$script = <<<JS
document.querySelectorAll('.delete-car').forEach(button => {
    button.addEventListener('click', function(event) {
        event.preventDefault();

        const url = this.dataset.url;

        Swal.fire({
            title: 'Biztosan törlöd ezt az autót?',
            text: 'Az összes hozzátartozó költés is törlésre kerül!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Igen, töröld!',
            cancelButtonText: 'Mégse',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = url;

                const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = '_csrf';
                input.value = csrf;

                form.appendChild(input);
                document.body.appendChild(form);
                form.submit();
            }
        });
    });
});
JS;
$this->registerJs($script);
?>