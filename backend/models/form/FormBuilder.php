<?php
/**
 * Formbuilder.php
 *
 * @Author: renk(renk@yiipal.com)
 * @Date: 2016/3/4
 */

namespace backend\models\form;

use common\base\BaseModel;
use common\models\behaviors\AttachDataFieldBehavior;

class FormBuilder extends BaseModel
{
    public static function tableName()
    {
        return 'config';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            AttachDataFieldBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $rules = [
            ['collection','default','value'=>'form'],
            [['data_label', 'name'], 'required'],
            [['data_description','collection'], 'safe'],
            ['name', 'match', 'pattern' => '/^[a-z][a-z0-9]*$/i'],
            ['name', 'validateUniqueName', 'on' => 'create'],
        ];

        return $rules;
    }

    /**
     * the form name should be unique..
     * @param $attribute
     */
    public function validateUniqueName($attribute)
    {
        $result = self::findOne(['name' => $this->$attribute]);
        if ($result) {
            $this->addError($attribute, '表单名已经存在！');
        }
    }

    public function attributeLabels()
    {
        return [
            'name' => '系统名（英文）',
            'data_label' => '名称',
            'data_description' => '描述',
        ];
    }

//    public function beforeSave($insert)
//    {
//        if (parent::beforeSave($insert)) {
//            $this->data = new \stdClass();
//            $this->data->label = $this->label;
//            $this->data->description = $this->description;
//            return true;
//        } else {
//            return false;
//        }
//    }
}