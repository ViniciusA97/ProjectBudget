<?php

namespace Api\Repository;

use Api\DTO\DTO;
use Api\Interfaces\DTO\AbstractDTO;
use Api\Interfaces\Repository\IRepository;
use Illuminate\Database\Eloquent\Model;
use Api\Models\TagModel;
use Exception;

class TagRepository implements IRepository{

    private Model $model;

    public function __construct(){
        $this->model = new TagModel();
    }

    public function getAll(){
        return $this->model::all();
    }

    public function getById($id){
        try{
            $data = $this->model->find($id);
            $subtags = $data->subtag()->get();
            $response = ['tag'=>$data, 'subtags'=>$subtags];
            return response($response,200);
        }catch(Exception $e){
            return response('Error. Não foi possível achar um extrato com esse id.', 404);
        }
    }

    public function save(AbstractDTO $dto){
        try{
            $data = $this->getData($dto);
            $this->model = $this->model->create($data);
            $insert = $this->model->toArray();
            return response($insert,201);
        }catch(Exception $e){
            return response('Houve um problema ao salvar a tag: '.$e->getMessage(), 500);
        }
    }

    public function update(AbstractDTO $dto){
        try{
            $response = $this->model->where('id',$dto->get('id'))->update($dto->all());
            return response($response);
        }catch(Exception $e){
            return response($e->getMessage());
        }

    }
    
    public function delete($id){
        try{
            $this->model->find($id)->delete();
            return response(['sucess'=>true],200);
        }catch(Exception $e){
            return response('Houve um problema para deletar.');
        }
    }

    private function getData(AbstractDTO $dto){
        $response = array();
        $response['name']= $dto->get('name');
        return $response;
    }
}

?>