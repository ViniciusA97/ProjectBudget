<?php

namespace Api\Interfaces\Repository;

use Api\DTO\DTO;
use Api\Interfaces\DTO\AbstractDTO;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository{

    protected Model $model;

    abstract protected function update(AbstractDTO $data);
    abstract protected function delete($id);
    abstract protected function save(AbstractDTO $data);
    abstract protected function getAll();
    abstract protected function getById(int $id);
    abstract protected function buildQuery();
    abstract protected function buildResponse($query);
}
?>