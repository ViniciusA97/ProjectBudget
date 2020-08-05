<?php

namespace Api\Repository;

use Api\DTO\DTO;
use Api\Interfaces\DTO\AbstractDTO;
use Api\Interfaces\Repository\AbstractRepository;
use Api\Models\ExtractModel;
use Exception;

class ExtractRepository extends AbstractRepository{


    public function __construct(){
        $this->model = new ExtractModel();
    }

    protected function getAll(){
        return $this->model::all();
    }

    protected function getById(int $id){
        return $this->model::find($id)->get();
    }

    public function getAllByIdUser(int $id){
        return $this->model::where('user_id',$id)->get();
    }

    public function save(DTO $dto){
        try{
            date_default_timezone_set("America/recife");
            $date = date('Y-m-d H:i:s');
            $desctiption = $dto->get('description');
            $value = $dto->get('value');
            $user_id = $dto->get('user_id');
            $this->model->value = $value;
            $this->model->user_id = $user_id;
            $this->model->description = $desctiption;
            $this->model->date = $date;
            if($dto->has('subtag_id')){
                $this->model->subtag_id = $dto->get('subtag_id');  
            }else{
                $this->model->investimento_id = $dto->get('investimento_id');
            }
            $this->model->save();
            return response($dto->all());
        }catch(Exception $e){
            return response('Houve um problema ao salvar o dado: '.$e->getMessage(), 500);
        }

    }

    public function update(){}
    
    public function delete($id){}
}

?>