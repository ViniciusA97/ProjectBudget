<?php

namespace Api\Repository;

use Api\DTO\DTO;
use Api\Interfaces\DTO\AbstractDTO;

use Api\DTO\DTOResponseRepository;
use Api\DTO\DTORepository;
use Api\Interfaces\Repository\IRepository;
use Api\Interfaces\Repository\IRepositoryDatabase;
use Illuminate\Database\Eloquent\Model;
use Api\Models\InvestimentoModel;
use Exception;

class InvestimentoRepository implements IRepository,IRepositoryDatabase{

    private Model $model;

    public function __construct(){
        $this->model = new InvestimentoModel();
    }

    public function getAll():DTOResponseRepository{
        return $this->model::all();
    }

    public function getById( $id):DTOResponseRepository{
        try{
            $data = $this->model->find($id);
            $response = $this->buildData($data);
            return new DTOResponseRepository($response,true,'');
        }catch(Exception $e){
            return new DTOResponseRepository([],false,$e->getMessage());
        }
    }

    public function getAllByIdUser($id):DTOResponseRepository{
        try{
            $data = $this->model->where('user_id',$id)->get();
            return response($data);
        }catch(Exception $e){
            return response('Não foi possivel achar o usuario',404);
        }
    }

    public function save(AbstractDTO $data):DTOResponseRepository{
        try{
            $value = $this->getData($data);
            $insert = $this->model->create($value);
            $response = $this->buildData($insert);
            return new DTOResponseRepository($response,true,'');
        }catch(Exception $e){
            return new DTOResponseRepository([],false,$e->getMessage());
        }
    }

    public function update(AbstractDTO $data):DTOResponseRepository{
        try{
            $column = $this->model::find($data->get('id'));
            $array = $data->all();
            if($data->has('subtag_id') && isset($column['subtag_id'])){ //significa que era de um investimento
                $array = $data->all();
                $array['investimento_id'] = null;
            }else if($data->has('investimento_id') && isset($column['investimento_id'])){ //significa que está trocando de investimento para subtasg
                $array = $data->all();
                $array['subtag_id'] = null;
            }
            $column->update($array);
            $response = $this->buildData($column);
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
        date_default_timezone_set("America/recife");
        $response = array();
        $response['date'] = date('Y-m-d H:i:s');
        $response['description'] = $dto->get('description');
        $response['meta_value'] = $dto->get('meta_value');
        $response['user_id'] = $dto->get('user_id');
        $response['name'] = $dto->get('name');
        return $response;
    }

    public function buildData($data):DTORepository{
        $extract = $data->extract()->get();
        $response['investimento'] = $data;
        $response['investimento']['extract'] = $extract;
        return new DTORepository(true, $response);
    }
}

?>