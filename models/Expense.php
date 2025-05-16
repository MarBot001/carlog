<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Expense extends ActiveRecord
{
    public static function tableName()
    {
        return 'expense';
    }

    public function rules()
    {
        return [
            [['car_id', 'type', 'amount', 'date', 'title'], 'required', 'message' => 'Kötelező mező!'],
            [['car_id'], 'integer'],
            [['amount'], 'number'],
            [['date'], 'safe'],
            [['description'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['type'], 'in', 'range' => ['fuel', 'cost', 'repair']],
        ];
    }

    public function getCar()
    {
        return $this->hasOne(Car::class, ['id' => 'car_id']);
    }
}
