<?php

class update
{
    function selectTable($table_name, $condition) : string
    {
        return "UPDATE $table_name SET $condition";
    }
}

$update = new update();