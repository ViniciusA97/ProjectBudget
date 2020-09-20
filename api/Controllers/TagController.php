<?php

namespace Api\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Api\Presenter\TagPresenter;
use Api\DTO\DTO;

class TagController extends Controller{
    // CRUD = Create Read Update Deletes

    public function __construct(){
        $this->presenter = new TagPresenter();
    }

    public function get($id){
        return $this->presenter->read($id);
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
