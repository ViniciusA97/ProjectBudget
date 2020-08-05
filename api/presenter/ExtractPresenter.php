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

    protected function read($id){
        return response($this->repository->getAllByIdUser($id),201);
    }

    public function create(AbstractDTO $dto){
        if((!$dto->has('subtag_id') && !$dto->has('investimento_id')) || 
            ($dto->has('subtag_id') && $dto->has('investimento_id'))){
            return response('A requisição de ter um field subtag_id OU investimento_id',406);
        }
       return $this->repository->save($dto);

    }

    protected function delete($id){

    }

    public function update($json){

    }

    public function readtest($id){
        return response($this->repository->getAllByIdUser($id),201);
    }

    

}
?>
