<?php

namespace Api\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Api\Presenter\ExtractPresenter;

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
        return $this->presenter->create($request);
    }

    public function put(){
        return 'Extract Update';
    }

    public function delete(){
        return 'Extract Delete';
    }

}
