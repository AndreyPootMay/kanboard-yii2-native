<?php

use yii\helpers\Html;
use kartik\sortinput\SortableInput;

// Scenario # 5:Connected sortables where one can modify connected sortable inputs.
echo '<div class="row" id="kanboard">';
echo '<div class="col-sm-4">';
echo SortableInput::widget([
    'name' => 'kv-conn-1',
    'items' => $taskbyId1,
    'hideInput' => false,
    'sortableOptions' => [
        'connected' => true,
    ],
    'options' => ['class' => 'form-control', 'readonly' => true, 'id' => 'sortable1-sortable', 'style' => 'display:none;']
]);

echo '</div>';
echo '<div class="col-sm-4">';
echo SortableInput::widget([
    'name' => 'kv-conn-2',
    'items' => $taskbyId2,
    'hideInput' => false,
    'sortableOptions' => [
        'itemOptions' => ['class' => 'alert alert-success'],
        'connected' => true,
    ],
    'options' => ['class' => 'form-control', 'readonly' => true, 'id' => 'sortable2-sortable', 'style' => 'display:none;']
]);

echo '</div>';
echo '<div class="col-sm-4">';
    echo SortableInput::widget([
        'name' => 'kv-conn-3',
        'items' => $taskbyId3,
        'hideInput' => false,
        'sortableOptions' => [
            'itemOptions' => ['class' => 'alert alert-warning'],
            'connected' => true,
        ],
        'options' => ['class' => 'form-control', 'readonly' => true, 'id' => 'sortable3-sortable']
    ]);
    echo '</div>';

    echo '</div>';
    echo Html::resetButton('Reset Form', ['class' => 'btn btn-secondary']);
