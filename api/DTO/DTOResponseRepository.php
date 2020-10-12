<?php

namespace Api\DTO;

class DTOResponseRepository{


    private $responseData;
    private $responseStatus;
    private $responseError;

    public function __construct($data, $status, $error){
        $this->responseStatus = $status;
        $this->responseData = $data;
        $this->responseError = $error;
    }

    public function getResponse():array{
        $response = [];
        if($this->responseStatus){
            $response= [
                "success"=>$this->responseStatus,
                "data"=>$this->responseData
            ];
           
        }else{
            
            $response = [
                "error"=>$this->responseError,
                "success"=>$this->responseStatus,
            ];
        }

        return $response;
    }

    public function isSuccess(){
        return $this->responseStatus;
    }


}
?>