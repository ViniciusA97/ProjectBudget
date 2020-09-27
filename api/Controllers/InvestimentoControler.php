<?php

namespace Api\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Api\Presenter\InvestimentoPresenter;
use Api\Repository\InvestimentoRepository;
use Api\DTO\DTO;

class InvestimentoController extends Controller{
    // CRUD = Create Read Update Deletes

    public function get($id){
        $repository = new InvestimentoRepository();
        $presenter = new InvestimentoPresenter($repository);
        return $presenter->getById($id);
    }

    public function getByUser(Request $request,$id){
        $repository = new InvestimentoRepository();
        $presenter = new InvestimentoPresenter($repository);
        return $presenter->read($id);
    }

    public function post(Request $request){
        $dto = new DTO($request);
        $repository = new InvestimentoRepository();
        $presenter = new InvestimentoPresenter($repository);
        return $presenter->create($dto);
    }

    public function update(Request $request){
        $dto = new DTO($request);
        $repository = new InvestimentoRepository();
        $presenter = new InvestimentoPresenter($repository);
        return $presenter->update($dto);
    }

    public function delete(Request $request, $id){
        $repository = new InvestimentoRepository();
        $presenter = new InvestimentoPresenter($repository);
        return $presenter->delete($id);
    }

}
