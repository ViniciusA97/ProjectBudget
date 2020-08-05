<?php

namespace Api\Interfaces\DTO;

use Illuminate\Http\Client\Request;
use Illuminate\Http\Request as HttpRequest;

abstract class AbstractDTO{

    protected array $data;

    public function __construct(HttpRequest $request){
        $this->data = $request->all();
    }

    abstract protected function get($param);
    abstract public function has($param);
    public function all(){
        return $this->data;
    }
}
?>