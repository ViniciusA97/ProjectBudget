<?php

namespace Api\Interfaces\Repository;

use Api\DTO\DTO;
use Api\Interfaces\DTO\AbstractDTO;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository{

    protected Model $model;

    abstract protected function update();
    abstract protected function delete($id);
    abstract protected function save(DTO $data);
    abstract protected function getAll();
    abstract protected function getById(int $id);
}
?>