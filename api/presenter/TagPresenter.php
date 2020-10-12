<?php

namespace Api\Presenter;

use Api\Interfaces\DTO\AbstractDTO;
use Api\DTO\DTOResponseRepository;
use Api\Interfaces\Presenter\IPresenter;
use Api\Interfaces\Repository\IRepository;
use Api\Repository\TagRepository;

class TagPresenter implements IPresenter{

    private IRepository $repository;

    public function __construct(IRepository $repo){
        $this->repository =  $repo;
    }

    public function create(AbstractDTO $dto){  
       $response =  $this->repository->save($dto);
       $status = $response->isSuccess() ? 201 : 400;
       return response()->json([$response->getResponse()],$status);
    }

    public function delete($id){
        $response = $this->repository->delete($id);
        $status = $response->isSuccess() ? 200 : 404;
        return response()->json([$response->getResponse()],$status);
    }

    public function update(AbstractDTO $dto){
        if(!$dto->has('id')){
            return response('A requisição deve ter o id do extract', 406);
        }
        $response =  $this->repository->update($dto);
        $status = $response->isSuccess() ? 200 : 404;
        return response()->json([$response->getResponse()],$status);
    }

    public function read($id){
        $response = $this->repository->getById($id);
        $status = $response->isSuccess() ? 200 : 404;
        return response()->json([$response->getResponse()],$status);
    }
}
?>
