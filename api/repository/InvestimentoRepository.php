<?php

namespace Api\Repository;

use Api\DTO\DTO;
use Api\Interfaces\DTO\AbstractDTO;
use Api\Interfaces\Repository\IRepository;
use Illuminate\Database\Eloquent\Model;
use Api\Models\investimentoModel;
use Exception;

class InvestimentoRepository implements IRepository{

    private Model $model;

    public function __construct(){
        $this->model = new InvestimentoModel();
    }

    protected function getAll(){
        return $this->model::all();
    }

    protected function getById( $id){
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
        try{
            $column = $this->model::where('id',$dto->get('id'))->get();
            if($dto->has('subtag_id') && isset($column['subtag_id'])){ //significa que era de um investimento
                $array = $dto->all();
                $array['investimento_id'] = null;
            }else if($dto->has('investimento_id') && isset($column['investimento_id'])){ //significa que está trocando de investimento para subtasg
                $array = $dto->all();
                $array['subtag_id'] = null;
            }
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