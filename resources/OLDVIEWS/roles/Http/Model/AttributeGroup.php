<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class AttributeGroup extends Model
{
    //
    protected $table = 'attribute_group';
    public $timestamps = false;
    protected $primaryKey = "attribute_group_id";
}
