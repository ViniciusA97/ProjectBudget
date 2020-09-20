<?php

namespace Api\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Api\Presenter\SubtagPresenter;
use Api\DTO\DTO;

class SubtagController extends Controller{
    // CRUD = Create Read Update Deletes

    public function __construct(){
        $this->presenter = new SubtagPresenter();
    }

    public function get($id){
        return $this->presenter->getById($id);
    }

    public function post(Request $request){
        $dto = new DTO($request);
        return $this->presenter->create($dto);
    }

    public function update(Request $request){
        $dto = new DTO($request);
        return $this->presenter->update($dto);
    }

    public function delete(Request $request, $id){
        return $this->presenter->delete($id);
    }

}
