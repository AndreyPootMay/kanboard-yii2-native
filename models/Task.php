<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "task".
 *
 * @property int $id
 * @property string $task_name
 * @property string $details
 * @property int $column_changed_at
 * @property int $created_at
 * @property int $column_id
 * @property int $position
 */
class Task extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['task_name', 'details'], 'required'],
            [['details'], 'string'],
            [['column_changed_at', 'created_at', 'column_id', 'position'], 'integer'],
            [['task_name'], 'string', 'max' => 100],
            [['column_id'], 'default', 'value' => 1]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'task_name' => Yii::t('app', 'Tarea'),
            'details' => Yii::t('app', 'Detalles'),
            'column_changed_at' => Yii::t('app', 'Columna cambiada desde'),
            'created_at' => Yii::t('app', 'Creado el'),
            'column_id' => Yii::t('app', 'Id de la columna'),
            'position' => Yii::t('app', 'Posición'),
        ];
    }
}
