<?php

namespace Api\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Api\Presenter\TagPresenter;
use Api\Repository\TagRepository;
use Api\DTO\DTO;

class TagController extends Controller{
    // CRUD = Create Read Update Deletes

    public function get($id){
        $repository = new TagRepository();
        $presenter = new TagPresenter($repository);
        return $presenter->read($id);
    }

    public function post(Request $request){
        $dto = new DTO($request);
        $repository = new TagRepository();
        $presenter = new TagPresenter($repository);
        return $presenter->create($dto);
    }

    public function update(Request $request){
        $dto = new DTO($request);
        $repository = new TagRepository();
        $presenter = new TagPresenter($repository);
        return $presenter->update($dto);
    }

    public function delete(Request $request, $id){
        $repository = new TagRepository();
        $presenter = new TagPresenter($repository);
        return $presenter->delete($id);
    }

}
