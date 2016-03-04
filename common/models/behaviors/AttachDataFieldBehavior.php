<?php
/**
 * AttachDataFieldBehavior.php 
 *
 * @Author: renk(renk@yiipal.com)
 * @Date: 2016/3/4
 */

namespace common\models\behaviors;


use yii\behaviors\AttributeBehavior;
use yii\db\BaseActiveRecord;

class AttachDataFieldBehavior extends AttributeBehavior{
    public function __get($name)
    {
        if($dataName = $this->getSerializeFieldName($name)){
            if(isset($this->owner->data[$dataName])){
                return $this->owner->data[$dataName];
            }else{
                return null;
            }
        }else{
            return parent::__get($name);
        }
    }

    public function __set($name, $value)
    {
        if($dataName = $this->getSerializeFieldName($name)){
            if(is_array($this->owner->data)){
                $data = $this->owner->data;
                $data[$dataName] = $value;
                $this->owner->data = $data;
            }elseif($name == 'data'){
                $this->owner->data = serialize($value);
            }else{
                $this->owner->data = [$dataName => $value];
            }
        }else{
            parent::__set($name, $value);
        }
    }

    public function events()
    {
        return [
            BaseActiveRecord::EVENT_AFTER_FIND => 'unserializeDataField',
            BaseActiveRecord::EVENT_BEFORE_INSERT => 'serializeDataField',
            BaseActiveRecord::EVENT_BEFORE_UPDATE => 'serializeDataField',
        ];
    }

    public function canGetProperty($name, $checkVars = true)
    {
        return $this->checkSerializeField($name) || parent::canGetProperty($name, $checkVars);
    }

    public function canSetProperty($name, $checkVars = true)
    {
        return $this->checkSerializeField($name) || parent::canSetProperty($name, $checkVars);
    }

    public function unserializeDataField($event){
        $this->owner->data = unserialize($this->owner->data);
    }
    public function serializeDataField($event){
        $this->owner->data = serialize($this->owner->data);
    }

    private function checkSerializeField($name){
        return preg_match('/^data_.*/', $name);
    }

    private function getSerializeFieldName($name){
        preg_match('/^data_(.*)/', $name, $matches);
        return $matches?$matches[1]:'';
    }
}