<?php

namespace Api\Presenter;

use Exception;
use Api\Interfaces\Presenter\AbstractPresenter;
use Api\Models\ExtractModel;
use Api\Repository\ExtractRepository;
use Illuminate\Http\Request;

class ExtractPresenter extends AbstractPresenter{

    public function __construct(){
        $this->model = new ExtractModel();
        $this->repository =  new ExtractRepository();
    }

    protected function read(Request $request){
        return response($this->repository->getAllByIdUser($request->user_id),201);
    }

    public function create($json){
        if((!$json->has('subtag_id') && !$json->has('investimento_id')) || 
            ($json->has('subtag_id') && $json->has('investimento_id'))){
            return response('A requisição de ter um field subtag_id OU investimento_id',406);
        }
        try{
            date_default_timezone_set("America/recife");
            $date = date('Y-m-d H:i:s');
            $desctiption = $json->description;
            $value = $json->value;
            $user_id = $json->user_id;
            $sub = $json->subtag_id;
            $this->model->value = $value;
            $this->model->user_id = $user_id;
            $this->model->description = $desctiption;
            $this->model->date = $date;
            if($json->has('subtag_id')){
                $this->model->subtag_id = $json->subtag_id;  
            }else{
                $this->model->investimento_id = $json->investimento_id;
            }
            $this->model->save();
            return response($json->all());
        }catch(Exception $e){
            return response('Houve um problema ao salvar o dado: '.$e->getMessage(), 500);
        }

    }

    protected function delete($id){

    }

    public function update($json){

    }

    public function readtest($id){
        return response($this->repository->getAllByIdUser($id),201);
    }

    

}
?>
