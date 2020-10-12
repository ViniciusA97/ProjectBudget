<?php

namespace Api\Presenter;

use Api\Interfaces\DTO\AbstractDTO;
use Api\Interfaces\Presenter\IPresenter;
use Api\Interfaces\Repository\IRepository;
use Api\DTO\DTOResponseRepository;

class SubtagPresenter implements IPresenter{

    private IRepository $repository;

    public function __construct(IRepository $repository){
        $this->repository =  $repository;
    }

    public function read($id){
        $response =  $this->repository->getAllByIdUser($id);
        $status = $response->isSuccess() ? 201 : 400;
       return response()->json([$response->getResponse()],$status);
    }

    public function create(AbstractDTO $dto){  
       $response =  $this->repository->save($dto);
       $status = $response->isSuccess() ? 201 : 400;
       return response()->json([$response->getResponse()],$status);
    }

    public function delete($id){
        $response =  $this->repository->delete($id);
        $status = $response->isSuccess() ? 201 : 400;
        return response()->json([$response->getResponse()],$status);
    }

    public function update(AbstractDTO $dto){
        if(!$dto->has('id')){
            return response('A requisição deve ter o id do extract', 406);
        }
        $response =  $this->repository->update($dto);
        $status = $response->isSuccess() ? 201 : 400;
        return response()->json([$response->getResponse()],$status);
    }

    public function getById($id){
        $response =  $this->repository->getById($id);
        $status = $response->isSuccess() ? 201 : 400;
        return response()->json([$response->getResponse()],$status);
    }

    

}
?>
