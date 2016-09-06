<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "companies".
 *
 * @property integer $id
 * @property string $name
 * @property string $telephone
 * @property string $address
 * @property string $representative
 * @property string $description
 *
 * @property Contracts[] $contracts
 */
class Companies extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'companies';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 50],
            [['telephone'], 'string', 'max' => 20],
            [['address'], 'string', 'max' => 150],
            [['representative'], 'string', 'max' => 100],
            [['description'], 'string', 'max' => 2000],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'telephone' => 'Telephone',
            'address' => 'Address',
            'representative' => 'Representative',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContracts()
    {
        return $this->hasMany(Contracts::className(), ['company_id' => 'id']);
    }
}
