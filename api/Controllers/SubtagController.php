<?php

namespace Api\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Api\Presenter\SubtagPresenter;
use Api\Repository\SubtagRepository;
use Api\DTO\DTO;

class SubtagController extends Controller{
    // CRUD = Create Read Update Deletes

    public function get($id){
        $repository = new SubtagRepository();
        $presenter = new SubtagPresenter();
        return $presenter->getById($id);
    }

    public function post(Request $request){
        $dto = new DTO($request);
        $repository = new SubtagRepository();
        $presenter = new SubtagPresenter();
        return $presenter->create($dto);
    }

    public function update(Request $request){
        $dto = new DTO($request);
        $repository = new SubtagRepository();
        $presenter = new SubtagPresenter();
        return $presenter->update($dto);
    }

    public function delete(Request $request, $id){
        $repository = new SubtagRepository();
        $presenter = new SubtagPresenter();
        return $presenter->delete($id);
    }

}
