<?php

namespace Models;

use database\database;

class Model
{

    public function save()  // no type because save can return all kinds of models
    {

        $db = database::getInstance();
        if (isset($this->database_id)) {
            $db->table($this->table_name)->where('id', '=', $this->database_id)->update(
                get_object_vars($this));
        } else {
            $db->table($this->table_name)->insert(
                get_object_vars($this)
            );
        }

        return $this;
    }

}