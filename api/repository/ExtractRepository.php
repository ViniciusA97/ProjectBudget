<?php

namespace Api\Repository;

use Api\DTO\DTO;
use Api\Interfaces\DTO\AbstractDTO;
use Api\Interfaces\Repository\AbstractRepository;
use Api\Models\ExtractModel;
use Exception;

//TAG ID teste : 92263a26-d72d-11ea-993a-7f2144f8b4b8
//SUBTAG ID TESTE: c6527e4a-d72d-11ea-993b-0b266f814453
//user teste: 3fe435f0-d72e-11ea-993d-034fd2c10ee5


class ExtractRepository extends AbstractRepository{


    public function __construct(){
        $this->model = new ExtractModel();
    }

    protected function getAll(){
        return $this->model::all();
    }

    protected function getById(int $id){
        try{
            return response($this->model->find($id),200);
        }catch(Exception $e){
            return response('Error. Não foi possível achar um extrato com esse id.', 404);
        }
    }

    public function getAllByIdUser($id){
        try{
            $data = $this->model->where('user_id',$id)->get();
            return response($data);
        }catch(Exception $e){
            return response('Não foi possivel achar o usuario',404);
        }
    }

    public function save(AbstractDTO $dto){
        try{
            date_default_timezone_set("America/recife");
            $data = $this->getData($dto);
            $this->model = $this->model->create($data);
            $insert = $this->model->toArray();
            return response($insert,201);
        }catch(Exception $e){
            return response('Houve um problema ao salvar o dado: '.$e->getMessage(), 500);
        }
    }

    public function update(AbstractDTO $dto){
        $column = $this->model::where('id',$dto->get('id'))->get();
        if($dto->has('subtag_id') && isset($column['subtag_id'])){ //significa que era de um investimento
            $array = $dto->all();
            $array['investimento_id'] = null;
        }else if($dto->has('subtag_id') && !isset($column['investimento_id'])){ //significa que esta mudando a subtag
            $array = $dto->all();
        }else if($dto->has('investimento_id') && isset($column['investimento_id'])){ //significa que está trocando de investimento para subtasg
            $array = $dto->all();
            $array['subtag_id'] = null;
        }else{
            $array = $dto->all();
        }
        try{
            $this->model->find($dto->get('id'))->update($array);
            return response($array);
        }catch(Exception $e){
            return response($e->getMessage());
        }

    }
    
    public function delete($id){
        try{
            $this->model->find($id)->delete();
            return response('Deleted',200);
        }catch(Exception $e){
            return response('Houve um problema para deletar.');
        }
    }

    private function getData(AbstractDTO $dto){
        date_default_timezone_set("America/recife");
        $response = array();
        $response['date'] = date('Y-m-d H:i:s');
        $response['description'] = $dto->get('description');
        $response['value'] = $dto->get('value');
        $response['user_id'] = $dto->get('user_id');
        if($dto->has('subtag_id')){
           $response['subtag_id'] = $dto->get('subtag_id');  
        }else{
            $response['investimento_id']= $dto->get('investimento_id');
        }
        return $response;
    }
}

?>