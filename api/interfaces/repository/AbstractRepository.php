<?php

namespace Api\Interfaces\Repository;

use Api\Interfaces\DTO\AbstractDTO;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository{

    protected Model $model;

    abstract protected function update();
    abstract protected function delete(int $id);
    abstract protected function save(AbstractDTO $data);
    abstract protected function getAll();
    abstract protected function getById(int $id);
}
?>