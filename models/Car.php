<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * Ez az osztály a 'car' tábla modellje.
 *
 * @property int $id
 * @property int $user_id
 * @property string $brand
 * @property string $model
 * @property string $edition
 * @property int $year
 *
 * @property User $user
 */
class Car extends ActiveRecord
{
    public static function tableName()
    {
        return 'car';
    }

    public function rules()
    {
        return [
            [['brand', 'model', 'edition', 'year'], 'required'],
            [['brand', 'model', 'edition'], 'string', 'max' => 100],
            [['year'], 'integer', 'min' => 1900, 'max' => date('Y')],
            [['user_id'], 'integer'],
            [['user_id'], 'exist', 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'Felhasználó',
            'brand' => 'Gyártó',
            'model' => 'Típus',
            'edition' => 'Kiadás',
            'year' => 'Évjárat',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
