<?php
/**
 * Config.php 
 *
 * @Author: renk(renk@yiipal.com)
 * @Date: 2016/3/4
 */

namespace common\base;


use yii\base\InvalidCallException;

class Config extends BaseModel{

    private $model=null;

    public static function tableName()
    {
        return 'config';
    }

    public static function loadData($collection, $name){
        $instance = new self();
        $instance->model = parent::findOne(['collection' => $collection,'name'=>$name])?:self::createData($collection, $name);
        return $instance;
    }

    public static function createData($collection, $name){
        $instance = new self();
        $instance->collection = $collection;
        $instance->name = $name;
        return $instance;
    }

    public static function removeData($collection, $name=null){
        $instance = parent::find(['collection' => $collection]);
        if($name){
            $instance->where(['name'=>$name]);
        }
        return $instance->one()->delete();
    }

    private function unserializeData(){
        if($this->model){
            $this->model->data = unserialize($this->model->data)?:new \stdClass();
        }
    }

    public function get($name){
        if($this->model){
            $data = unserialize($this->model->data);
            return $data?$data->{$name}:null;
        }

        throw new InvalidCallException();
    }

    public function set($name,$value){
        if($this->model){
            $data = unserialize($this->model->data)?:new \stdClass();
            $data->{$name} = $value;
            $this->model->data= serialize($data);
            return $this->model->save();
        }
        throw new InvalidCallException();
    }


}