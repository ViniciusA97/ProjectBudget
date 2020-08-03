<?php

namespace Api\Repository;

use Api\Interfaces\DTO\AbstractDTO;
use Api\Interfaces\Repository\AbstractRepository;
use Api\Models\ExtractModel;

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

    protected function save(AbstractDTO $data){}

    protected function update(){}
    
    protected function delete(int $id){}
}

?>