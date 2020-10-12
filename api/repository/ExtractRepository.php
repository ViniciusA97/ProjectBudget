<?php

namespace Api\Repository;

use Api\DTO\DTO;
use Api\DTO\DTOResponseRepository;
use Api\DTO\DTORepository;
use Api\Interfaces\DTO\AbstractDTO;

use Api\Interfaces\Repository\IRepository;
use Api\Interfaces\Repository\IRepositoryDatabase;
use Api\Models\ExtractModel;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class ExtractRepository implements IRepository,IRepositoryDatabase{

    private Model $model;

    public function __construct(){
        $this->model = new ExtractModel();
    }

    public function getAll():DTOResponseRepository{
        return $this->model::all();
    }

    public function getById($id):DTOResponseRepository{ //OK
        try{
            $data = $this->model->find($id);
            $query = $this->buildData($data);
            if($query->status){
                return new DTOResponseRepository($query->data,true,'');
            }
            return new DTOResponseRepository([],false,'Não foi possivel achar um extract com este ID.');
        }catch(Exception $e){
            return new DTOResponseRepository([],false,$e->getMessage());
        }
    }

    public function getAllByIdUser($id):DTOResponseRepository{//ok
        try{
            $query = $this->model->where('user_id',$id)->get();
            if(empty($query->toArray())){
                return new DTOResponseRepository([],false,'Não foi possivel achar um usuario com este ID.');
            }
            $response = [];
            foreach($query as &$data){
                $temp = $this->buildData($data);
                if(!$temp->status){
                    continue;
                }
                $response[] = $temp->data;
            }
            return new DTOResponseRepository($response,true,'');
        }catch(Exception $e){
            return new DTOResponseRepository([],false,$e->getMessage());;
        }
    }

    public function save(AbstractDTO $dto):DTOResponseRepository{ //ok
        try{
            date_default_timezone_set("America/recife");
            $data = $this->getData($dto);
            $insert= $this->model->create($data);
            $response = $this->buildData($insert);
            return new DTOResponseRepository($response,true,'');
        }catch(Exception $e){
            return new DTOResponseRepository([],false,$e->getMessage());
        }
    }

    public function update(AbstractDTO $dto):DTOResponseRepository{ //ok
        try{
            $validate = $this->model::find($dto->get('id'));
            $array = $dto->all();
            if($dto->has('subtag_id') && isset($validate['subtag_id'])){ 
                $array = $dto->all();
                $array['investimento_id'] = null;
            }else if($dto->has('investimento_id') && isset($validate['investimento_id'])){ 
                $array = $dto->all();
                $array['subtag_id'] = null;
            }
            $query = $validate;
            if(is_null($query)){
                return new DTOResponseRepository([],false,'Não foi possivel achar um extrato com este ID.');
            }
            $response = $query->update($array);
            $data = $this->buildData($query);
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
            return new DTOResponseRepository([],false, $e->getMessage());
        }
    }

    private function getData(AbstractDTO $dto){
        $response = array();
        if(!$dto->has('date')){
            date_default_timezone_set("America/recife");
            $response['date'] = date('Y-m-d H:i:s');
        }   
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

    public function buildResponse($query){
        $resp = array();
            foreach($query[0] as $key => $value){
                if(!(is_null($value))){
                   $resp[$key] =$value; 
                }
            }
        return $resp;
    }

    public function buildData($data){
        if(is_null($data)){
            return new DTORepository(false,[]);
        }
        $subtag = $data->subtag()->get();
        $tag = $data->tag()->get();
        $investimento = $data->investimento()->get();
        $response = ['extract'=>$data];
        if(!empty($subtag->toArray())){
            $response['extract']['subtag'] = $subtag[0]; 
            $response['extract']['tag'] = $tag[0];
            unset($response['extract']['subtag']['tag_id']);
            unset($response['extract']['tag']['laravel_through_key']);
        }else{
            $response['extract']['investimento'] = $investimento;
            unset($response['extract']['investimento']['user_id']);
            unset($response['extract']['investimento']['updated_at']);
            unset($response['extract']['investimento']['created_at']);
        }

        unset($response['extract']['subtag_id']);
        unset($response['extract']['investimento_id']);

        return new DTORepository(true,$response);
    }

}

?>