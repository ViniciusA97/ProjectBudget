<?php

namespace Api\Interfaces\Repository;

use Api\DTO\DTO;
use Api\DTO\DTOResponseRepository;
use Api\Interfaces\DTO\AbstractDTO;

interface IRepository{

    public function update(AbstractDTO $data):DTOResponseRepository;
    public function delete($id):DTOResponseRepository;
    public function save(AbstractDTO $data):DTOResponseRepository;
    public function getAll():DTOResponseRepository;
    public function getById($id):DTOResponseRepository;
}
?>