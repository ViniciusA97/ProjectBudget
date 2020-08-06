<?php

namespace Api\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Api\Presenter\ExtractPresenter;
use Api\DTO\DTO;

class ExtractController extends Controller{
    // CRUD = Create Read Update Deletes

    public function __construct(){
        $this->presenter = new ExtractPresenter();
    }
//test
    public function get(Request $request){
        $test = $request->user_id
         ;
        return $test;
        return $this->presenter->readtest($request->user_id);
    }

    public function post(Request $request){
        $dto = new DTO($request);
        return $this->presenter->create($dto);
    }

    public function put(Request $request){
        return $request->json()->all();
        $dto = new DTO($request);
        return $this->presenter->update($dto);
    }

    public function delete(){
        return 'Extract Delete';
    }

}
