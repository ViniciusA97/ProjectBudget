<?php

namespace Api\Presenter;

use Api\Interfaces\DTO\AbstractDTO;
use Api\Interfaces\Presenter\IPresenter;
use Api\Interfaces\Repository\IRepository;
use Api\Repository\TagRepository;

class TagPresenter implements IPresenter{

    private IRepository $repository;

    public function __construct(IRepository $repo){
        $this->repository =  $repo;
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

    public function read($id){
        return $this->repository->getById($id);
    }

    

}
?>
