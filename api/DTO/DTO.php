<?php

namespace Api\DTO;

use Api\Interfaces\DTO\AbstractDTO;

class DTO extends AbstractDTO{

    public function get($param){
        if(is_null($this->data[$param])){
            return null;
        }
        return $this->data[$param];
    }

    public function has($param){
        if(isset($this->data[$param])){
            return $this->data[$param];
        }
        return null;
    }
}
?>