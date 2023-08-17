<?php

namespace Models;

class Role extends Model
{

        public String $name;
        public String $table_name = 'roles';

        public function __construct(String $name)
        {
            $this->name = $name;

            return $this;
        }
}