<?php

namespace Api\Repository;

use Api\DTO\DTO;
use Api\DTO\DTORepository;
use Api\DTO\DTOResponseRepository;
use Api\Interfaces\DTO\AbstractDTO;
use Api\Interfaces\Repository\IRepository;
use Api\Interfaces\Repository\IRepositoryDatabase;
use Illuminate\Database\Eloquent\Model;
use Api\Models\SubtagModel;
use Exception;

class SubtagRepository implements IRepository, IRepositoryDatabase{

    private Model $model;

    public function __construct(){
        $this->model = new SubtagModel();
    }

    public function getAll():DTOResponseRepository{
        $response =  $this->model::all();
        dd($response);
        $response->tag();
        return response($response);
    }

    public function getById($id):DTOResponseRepository{
        try{
            $data = $this->model->find($id);
            $response = $this->buildData($data);
            return new DTOResponseRepository($response,true,'');
        }catch(Exception $e){
            return new DTOResponseRepository([],false,$e->getMessage());
        }
    }

    public function save(AbstractDTO $dto):DTOResponseRepository{
        try{
            $data = $this->getData($dto);
            $insert = $this->model->create($data);
            $response = $this->buildData($insert);
            return new DTOResponseRepository($response,true,'');
        }catch(Exception $e){
            return new DTOResponseRepository([],false,$e->getMessage());
        }
    }

    public function update(AbstractDTO $dto):DTOResponseRepository{
        try{
            $query = $this->model->find($dto->get('id'));
            if(is_null($query)){
                return new DTOResponseRepository([],false,'Não foi possivel achar uma subtag com este ID.');
            }
            $query->update($dto->all());
            $response = $this->buildData($query);
            return new DTOResponseRepository($response,true,'');
        }catch(Exception $e){
            return new DTOResponseRepository([],false,$e->getMessage());
        }

    }
    
    public function delete($id):DTOResponseRepository{
        try{
            $this->model->find($id)->delete();
            return new DTOResponseRepository([],true,'');
        }catch(Exception $e){
            return new DTOResponseRepository([],false,$e->getMessage());
        }
    }

    private function getData(AbstractDTO $dto){
        $response = array();
        $response['name']= $dto->get('name');
        $response['tag_id'] = $dto->get('tag_id');
        return $response;
    }

    public function buildData($data):DTORepository{
        $tag = $data->tag()->get(); 
        $response = ['subtag'=>$data];
        $response['subtag']['tag'] = $tag;
        unset($response['subtag']['tag_id']);
        return new DTORepository(true,$response);
    }

}

?>