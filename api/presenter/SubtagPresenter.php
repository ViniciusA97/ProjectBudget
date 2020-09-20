<?php

namespace Api\Presenter;

use Api\Interfaces\DTO\AbstractDTO;
use Api\Interfaces\Presenter\AbstractPresenter;
use Api\Repository\SubtagRepository;

class SubtagPresenter extends AbstractPresenter{

    public function __construct(){
        $this->repository =  new SubtagRepository();
    }

    public function read($id){
        return $this->repository->getAllByIdUser($id);
    }

    public function create(AbstractDTO $dto){  
       return $this->repository->save($dto);
    }

    public function delete($id){
        return $this->repository->delete($id);
    }

    public function update(AbstractDTO $dto){
        if(!$dto->has('id')){
            return response('A requisição deve ter o id do extract', 406);
        }
        return $this->repository->update($dto);
    }

    public function getById($id){
        return $this->repository->getById($id);
    }

    

}
?>
