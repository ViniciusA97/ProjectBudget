<?php

namespace Api\Interfaces\Presenter;

use Api\Interfaces\Repository\AbstractRepository;
use Api\DTO\DTO;
use Api\Interfaces\DTO\AbstractDTO;
use Illuminate\Database\Eloquent\Model;


abstract class AbstractPresenter{

    protected AbstractRepository $repo;
    protected Model $model;

    abstract protected function create(AbstractDTO $dto);
    abstract protected function read($id);
    abstract protected function update(AbstractDTO $dto);
    abstract protected function delete($id);

}
?>