<?php

namespace app\models;

use Yii;
use app\models\StudentAppLink;

/**
 * This is the model class for table "applications".
 *
 * @property integer $id
 * @property integer $contract_id
 * @property string $start_date
 * @property string $end_date
 * @property integer $practice_type_id
 *
 * @property Contracts $contract
 * @property PracticeTypes $practiceType
 * @property StudentAppLink[] $studentAppLinks
 * @property Students $students
 */
class Applications extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'applications';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['contract_id', 'practice_type_id'], 'integer'],
            [['start_date', 'end_date'], 'safe'],
            [['contract_id'], 'exist', 'skipOnError' => true, 'targetClass' => Contracts::className(), 'targetAttribute' => ['contract_id' => 'id']],
            [['practice_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => PracticeTypes::className(), 'targetAttribute' => ['practice_type_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'contract_id' => 'Contract ID',
            'start_date' => 'Дата начала',
            'end_date' => 'Дата конца',
            'practice_type_id' => 'Practice Type ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContract()
    {
        return $this->hasOne(Contracts::className(), ['id' => 'contract_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPracticeType()
    {
        return $this->hasOne(PracticeTypes::className(), ['id' => 'practice_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentAppLinks()
    {
        return $this->hasMany(StudentAppLink::className(), ['app_id' => 'id']);
    }

    public function getStudents()
    {
        return $this->hasMany(Students::className(), ['login' => 'student_login'])->via('studentAppLinks');
    }

    public function beforeDelete()
    {
        if (parent::beforeDelete()) {
            if($this->getStudentAppLinks()->exists()){
                StudentAppLink::deleteAll(['app_id' => $this->id]);
            }
            return true;
        } else {
            return false;
        }
    }

}
