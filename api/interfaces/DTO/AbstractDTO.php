<?php

namespace Api\Interfaces\DTO;

use Illuminate\Http\Client\Request;
use Illuminate\Http\Request as HttpRequest;

abstract class AbstractDTO{

    protected array $data;

    public function __construct(HttpRequest $request){
        $this->data = $request->all();
        //{subtag_id:1, sfjkskjfnjsa}
    }

    public function get($param){
        if(is_null($this->data[$param])){
            return null;
        }
        return $this->data[$param];
    }

    public function has($param){
        if(array_key_exists($param, $this->data)){
            return true;
        }
        return false;
    }
    public function all(){
        return $this->data;
    }
}
?>