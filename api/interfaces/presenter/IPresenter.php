<?php

namespace Api\Interfaces\Presenter;

use Api\Interfaces\DTO\AbstractDTO;

interface IPresenter{

     public function create(AbstractDTO $dto);
     public function read($id);
     public function update(AbstractDTO $dto);
     public function delete($id);

}
?>