<?php

namespace Api\Presenter;

use Api\Interfaces\DTO\AbstractDTO;
use Exception;
use Api\Interfaces\Presenter\AbstractPresenter;
use Api\Models\ExtractModel;
use Api\Repository\ExtractRepository;
use DTO;
use Illuminate\Http\Request;

class ExtractPresenter extends AbstractPresenter{

    public function __construct(){
        $this->model = new ExtractModel();
        $this->repository =  new ExtractRepository();
    }

    public function read($id){
        return $this->repository->getAllByIdUser($id);
    }

    public function create(AbstractDTO $dto){
        if((!$dto->has('subtag_id') && !$dto->has('investimento_id')) || 
            ($dto->has('subtag_id') && $dto->has('investimento_id'))){
            return response('A requisição deve conter um field subtag_id OU investimento_id',406);
        }
       return $this->repository->save($dto);
    }

    public function delete($id){
        return $this->repository->delete($id);
    }

    public function update(AbstractDTO $dto){
        if(!$dto->has('id')){
            return response('A requisição deve ter o id do extract', 406);
        }
        else if($dto->has('subtag_id') && $dto->has('investimento_id')){
            return response('A requisição deve ter um subtag_id ou um investimento_id',406);
        }
        return $this->repository->update($dto);
    }

    

}
?>
