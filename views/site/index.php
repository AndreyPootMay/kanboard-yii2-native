<?php

use yii\helpers\Html;
use kartik\sortinput\SortableInput;
use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <div class="body-content">
        <?php
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

        ?>
    </div>
</div>

<?php
    $this->registerJs('
        $(document).ready(function(){
            $(".task").on("dragenter dragover dragleave dragstart", function () {
                console.log($(this).data("task-value"));
            });

            $("#sortable2-sortable").on("change", function () {
                changeColumnTasks(2, this.value);
            });

            $("#sortable1-sortable").on("change", function () {
                changeColumnTasks(1, this.value);
            });

            $("#sortable3-sortable").on("change", function () {
                changeColumnTasks(3, this.value);
            });

            /**
             * This function will change the column tasks ids. 
             */
            function changeColumnTasks(column_id, ids) {
                console.log("Columna " + column_id + ": " + ids);
                console.log(`' . Url::to(['task/update-column']) . '?column_id=${column_id}&ids${ids}`);

                $.ajax({
                    type: "get",
                    url: `' . Url::to(['task/update-column']) . '?column_id=${column_id}&ids=${ids}`,
                    cache: false,
                }).done(function(data) {
                    if (data.error) {
                        console.log(`Error:` + data.error);
                    } else {
                        console.log(`changed`);
                    }
                });
            }
        });
    '
);
?>