<?php

namespace App\DataObjects;

use Programm011\Dataobject\DataObject;

/**
 * Author: nizomiddin
 * Date: 11/1/24 11:56 AM
 **/
class TaskData extends DataObject
{
    public int     $id;
    public string  $title;
    public ?string $description;
    public bool    $completed;
}
