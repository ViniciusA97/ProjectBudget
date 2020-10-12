<?php

namespace Api\Presenter;

use Api\Interfaces\DTO\AbstractDTO;
use Exception;
use Api\Interfaces\Presenter\IPresenter;
use Api\Models\ExtractModel;
use Api\Interfaces\Repository\IRepository;
use DTO;
use DTOResponse;
use Illuminate\Http\Request;

class ExtractPresenter implements IPresenter{

    private IRepository $repository;

    public function __construct(IRepository $dependencie){
        $this->repository =  $dependencie;
    }

    public function read($id){
        $response = $this->repository->getAllByIdUser($id);
        $status = $response->isSuccess() ? 200 : 404 ;
        return response()->json([$response->getResponse()], $status);
    }

    public function create(AbstractDTO $dto){
        if((!$dto->has('subtag_id') && !$dto->has('investimento_id')) || 
            ($dto->has('subtag_id') && $dto->has('investimento_id'))){
            return response('A requisição deve conter um field subtag_id OU investimento_id',400);
        }
        $response = $this->repository->save($dto);
        $status = $response->isSuccess() ? 201 : 400 ;
        return response()->json([$response->getResponse()],$status);
    }

    public function delete($id){
        $response = $this->repository->delete($id);
        $status = $response->isSuccess() ? 200 : 400;
        return response()->json([$response->getResponse()],$status);
    }

    public function update(AbstractDTO $dto){
        if(!$dto->has('id')){
            return response('A requisição deve ter o id do extract', 406);
        }
        else if($dto->has('subtag_id') && $dto->has('investimento_id')){
            return response('A requisição deve ter um subtag_id ou um investimento_id',406);
        }
        $response =  $this->repository->update($dto);
        $status = $response->isSuccess() ? 200 : 400 ;
        return response()->json([$response->getResponse()],$status);
    }

    public function getById($id){
        $response = $this->repository->getById($id);
        $status = $response->isSuccess() ? 200 : 404 ;
        return response()->json([$response->getResponse()],$status);
    }

    

}
?>
