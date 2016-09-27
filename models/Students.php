<?php

namespace app\models;

use Yii;


/**
 * This is the model class for table "students".
 *
 * @property integer $login
 * @property string $name
 * @property integer $group_id
 *
 * @property StudentAppLink[] $studentAppLinks
 * @property StudentGroups $group
 * @property Applications $applications
 * @property Faculties $faculty
 * @property Companies $companies
 */
class Students extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'students';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['group_id'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => StudentGroups::className(), 'targetAttribute' => ['group_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'login' => 'Login',
            'name' => 'Name',
            'group_id' => 'Group ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentAppLinks()
    {
        return $this->hasMany(StudentAppLink::className(), ['student_login' => 'login']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApplications()
    {
        return $this->hasMany(Applications::className(), ['id' => 'app_id'])->via('studentAppLinks');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(StudentGroups::className(), ['id' => 'group_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFaculty()
    {
        return $this->hasOne(Faculties::className(), ['id' => 'faculty_id'])->via('group');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContracts()
    {
        return $this->hasMany(Contracts::className(), ['id' => 'contract_id'])->via('applications');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompanies()
    {
        return $this->hasMany(Companies::className(), ['id' => 'company_id'])->via('contracts');
    }

    /**
     * @return string
     */
    public function getHasApps()
    {
        if($this->getApplications()->exists()){
            return 'Да';
        } else return 'Нет';
    }
}
