<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "faculties".
 *
 * @property integer $id
 * @property string $name
 *
 * @property StudentGroups[] $studentGroups
 */
class Faculties extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'faculties';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 50],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentGroups()
    {
        return $this->hasMany(StudentGroups::className(), ['faculty_id' => 'id']);
    }
}
