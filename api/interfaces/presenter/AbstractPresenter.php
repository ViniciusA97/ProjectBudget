<?php

namespace Api\Interfaces\Presenter;

use Api\Interfaces\Repository\AbstractRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

abstract class AbstractPresenter{

    protected AbstractRepository $repo;
    protected Model $model;

    abstract protected function create($json);
    abstract protected function read(Request $request);
    abstract protected function update($json);
    abstract protected function delete($id);

}
?>