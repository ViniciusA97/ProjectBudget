<?php

namespace Api\Interfaces\Repository;

use Api\DTO\DTO;
use Api\Interfaces\DTO\AbstractDTO;

interface IRepository{

    public function update(AbstractDTO $data);
    public function delete($id);
    public function save(AbstractDTO $data);
    public function getAll();
    public function getById($id);
}
?>