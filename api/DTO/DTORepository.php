<?php

namespace Api\DTO;

class DTORepository{


    public $status;
    public $data;

    public function __construct($status, $data){
        $this->status = $status;
        $this->data = $data;
    }

    public function getResponse():array{
        return ['status'=>$this->status, 'data'=>$this->data];
    }


}
?>