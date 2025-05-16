<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Költéseim';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="expense-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="mb-3">
        <form method="get" action="<?= Url::to(['index']) ?>" class="form-inline">
            <label for="carFilter" class="form-label me-2">Szűrő:</label>
            <select name="car_id" id="carFilter" class="form-select w-auto d-inline-block me-2" onchange="this.form.submit()">
                <option value="">Minden autóm</option>
                <?php foreach ($userCars as $id => $name): ?>
                    <option value="<?= $id ?>" <?= $selectedCarId == $id ? 'selected' : '' ?>>
                        <?= Html::encode($name) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <noscript><button type="submit" class="btn btn-secondary">Szűrés</button></noscript>
        </form>
    </div>
    <?php if ($totalAmount !== null): ?>
        <div class="alert alert-secondary mt-3">
            Összes költés a kiválaszott autó(k)ra:<br><strong><?= number_format($totalAmount, 0, ',', ' ') ?> Ft</strong>
        </div>
    <?php endif; ?>

    <?= Html::a('<i class="bi bi-currency-dollar"></i> Költés hozzáadása', ['create'], ['class' => 'btn btn-primary btn-float']) ?>

    <ul class="list-group">
        <?php foreach ($expenses as $expense): ?>
            <li class="list-group-item">
                <i class="bi <?= Html::encode($expense->icon) ?>"></i>
                <strong><?= ucfirst($expense->title) ?></strong> –
                <?= Html::encode($expense->amount) ?> Ft

                <span class="float-end">
                    <?= Html::a('<i class="bi bi-box-arrow-up-right"></i>', ['update', 'id' => $expense->id], ['class' => 'btn btn-sm btn-outline-primary']) ?>
                    <?= Html::a('<i class="bi bi-trash"></i>', ['delete', 'id' => $expense->id], [
                        'class' => 'btn btn-sm btn-outline-danger delete-expense',
                        'data-id' => $expense->id,
                        'data-url' => Url::to(['delete', 'id' => $expense->id]),
                    ]) ?>
                </span>
            </li>

        <?php endforeach; ?>
    </ul>
</div>

<?php
$script = <<<JS
document.querySelectorAll('.delete-expense').forEach(button => {
    button.addEventListener('click', function(event) {
        event.preventDefault();

        const url = this.dataset.url;

        Swal.fire({
            title: 'Biztosan törlöd a költést?',
            text: 'Ez a művelet nem visszavonható!',
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
