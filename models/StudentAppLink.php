<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "student_app_link".
 *
 * @property integer $id
 * @property integer $student_login
 * @property integer $app_id
 *
 * @property Students $studentLogin
 * @property Applications $app
 */
class StudentAppLink extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'student_app_link';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['student_login', 'app_id'], 'required'],
            [['student_login', 'app_id'], 'integer'],
            [['student_login'], 'exist', 'skipOnError' => true, 'targetClass' => Students::className(), 'targetAttribute' => ['student_login' => 'login']],
            [['app_id'], 'exist', 'skipOnError' => true, 'targetClass' => Applications::className(), 'targetAttribute' => ['app_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'student_login' => 'Student Login',
            'app_id' => 'App ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentLogin()
    {
        return $this->hasOne(Students::className(), ['login' => 'student_login']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApp()
    {
        return $this->hasOne(Applications::className(), ['id' => 'app_id']);
    }
}
