<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "student_groups".
 *
 * @property integer $id
 * @property string $name
 * @property integer $year
 * @property integer $curriculum_id
 * @property integer $faculty_id
 *
 * @property Curricula $curriculum
 * @property Faculties $faculty
 * @property Students[] $students
 */
class StudentGroups extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'student_groups';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['year', 'curriculum_id', 'faculty_id'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['curriculum_id'], 'exist', 'skipOnError' => true, 'targetClass' => Curricula::className(), 'targetAttribute' => ['curriculum_id' => 'id']],
            [['faculty_id'], 'exist', 'skipOnError' => true, 'targetClass' => Faculties::className(), 'targetAttribute' => ['faculty_id' => 'id']],
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
            'year' => 'Year',
            'curriculum_id' => 'Curriculum ID',
            'faculty_id' => 'Faculty ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurriculum()
    {
        return $this->hasOne(Curricula::className(), ['id' => 'curriculum_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFaculty()
    {
        return $this->hasOne(Faculties::className(), ['id' => 'faculty_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudents()
    {
        return $this->hasMany(Students::className(), ['group_id' => 'id']);
    }
}
