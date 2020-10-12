<?php

namespace Api\Repository;

use Api\DTO\DTO;
use Api\DTO\DTORepository;
use Api\DTO\DTOResponseRepository;
use Api\Interfaces\DTO\AbstractDTO;

use Api\Interfaces\Repository\IRepository;
use Api\Interfaces\Repository\IRepositoryDatabase;
use Illuminate\Database\Eloquent\Model;
use Api\Models\TagModel;
use Exception;

class TagRepository implements IRepository, IRepositoryDatabase{

    private Model $model;

    public function __construct(){
        $this->model = new TagModel();
    }

    public function getAll():DTOResponseRepository{
        return $this->model::all();
    }

    public function getById($id):DTOResponseRepository{ //ok
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

    public function update(AbstractDTO $dto):DTOResponseRepository{ // ok
        try{
            $validate = $this->model::find($dto->get('id'));
            if(is_null($validate)){
                return new DTOResponseRepository([],false,'Não foi possivel achar um extrato com este ID.');
            }
            $validate->update($dto->all());
            $data = $this->buildData($validate);
            return new DTOResponseRepository([$data],true,'');
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
        return $response;
    }

    public function buildData($data):DTORepository{
        $subtags = $data->subtag()->get(['name','id']);
        $response = ['tag'=>$data];
        $response['tag']['subtags'] = $subtags;
        return new DTORepository(true, $response);
    }
}

?>