<?php

namespace Api\Repository;

use Api\DTO\DTO;
use Api\Interfaces\DTO\AbstractDTO;
use Api\Interfaces\Repository\AbstractRepository;
use Api\Models\ExtractModel;
use Exception;
use Illuminate\Support\Facades\DB;


class ExtractRepository extends AbstractRepository{


    public function __construct(){
        $this->model = new ExtractModel();
    }

    protected function getAll(){
        return $this->model::all();
    }

    public function getById( $id){
        try{
            $query = $this->buildQuery();
            $data = $query->where('extract.id',$id)->get()->toArray();
            return response($this->buildResponse($data),200);
        }catch(Exception $e){
            return response($e->getMessage(), 404);
        }
    }

    public function getAllByIdUser($id){
        try{
            $query = $this->buildQuery();
            $data = $query->where('user_id',$id)->get()->toArray();
            return response(200)->json($this->buildResponse($data));
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
            if($dto->has('subtag_id') && isset($column['subtag_id'])){ 
                $array = $dto->all();
                $array['investimento_id'] = null;
            }else if($dto->has('investimento_id') && isset($column['investimento_id'])){ 
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

    protected function buildResponse($query){
        $resp = array();
            foreach($query[0] as $key => $value){
                if(!(is_null($value))){
                   $resp[$key] =$value; 
                }
            }
        return $resp;
    }

    protected function buildQuery(){
        $query = DB::table('extract')
            ->leftJoin('subtag','extract.subtag_id','=','subtag.id')
            ->leftJoin('tag','subtag.tag_id','=','tag.id')
            ->leftJoin('investimento','extract.investimento_id','=','investimento.id')
            ->select('extract.*',
                    'subtag.name as subtag_name',
                    'investimento.name as investimento_name',
                    'investimento.description as investimento_description',
                    'investimento.id as investimento_id',
                    'tag.name as tag_name',
                    'tag.id as tag_id',);
        return $query;
    }
}

?>