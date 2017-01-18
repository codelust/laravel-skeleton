<?php

namespace Frontiernxt\Repositories\Contracts;

interface UserRepositoryInterface
{
    public function find();

    public function findBy($att, $column);
}

?>