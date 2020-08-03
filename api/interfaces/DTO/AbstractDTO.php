<?php

namespace Api\Interfaces\DTO;

use Illuminate\Http\Client\Request;
use PhpParser\Node\Expr\Cast\Array_;

abstract class AbstractDTO{

    protected Array $data;
    abstract protected function get();
}
?>