<?php

namespace Api\Repository;

use Api\DTO\DTO;
use Api\Interfaces\DTO\AbstractDTO;
use Api\Interfaces\Repository\AbstractRepository;
use Api\Models\SubtagModel;
use Exception;

class SubtagRepository extends AbstractRepository{


    public function __construct(){
        $this->model = new SubtagModel();
    }

    public function getAll(){
        $response =  $this->model::all();
        dd($response);
        $response->tag();
        return response($response);
    }

    public function getById($id){
        try{
            $data = $this->model->where('id',$id)->get();
            $response = ['subtag'=>$data, 'tag'=>$data[0]->tag()->get()];
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
            return response('Houve um problema ao salvar a subtag: '.$e->getMessage(), 500);
        }
    }

    public function update(AbstractDTO $dto){
        try{
            $response = $this->model->find($dto->get('id'))->update($dto->all());
            return response(['sucess'=>true],200);
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
        $response['tag_id'] = $dto->get('tag_id');
        return $response;
    }
}

?>