<?php

namespace Api\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Api\Presenter\ExtractPresenter;
use Api\DTO\DTO;
use Api\Repository\ExtractRepository;
use OpenApi\Annotations as OA;

class ExtractController extends Controller{
    // CRUD = Create Read Update Deletes
    // Inversão de dependencia 

    public function get($id){
        $reporitory = new ExtractRepository();
        $presenter = new ExtractPresenter($reporitory);
        return $presenter->getById($id);
    }

    public function getByUser(Request $request,$id){
        $reporitory = new ExtractRepository();
        $presenter = new ExtractPresenter($reporitory);
        return $presenter->read($id);
    }

    public function post(Request $request){
        $dto = new DTO($request);
        $reporitory = new ExtractRepository();
        $presenter = new ExtractPresenter($reporitory);
        return $presenter->create($dto);
    }

    public function update(Request $request){
        $dto = new DTO($request);
        $reporitory = new ExtractRepository();
        $presenter = new ExtractPresenter($reporitory);
        return $presenter->update($dto);
    }

    public function delete(Request $request, $id){
        $reporitory = new ExtractRepository();
        $presenter = new ExtractPresenter($reporitory);
        return $presenter->delete($id);
    }

}
