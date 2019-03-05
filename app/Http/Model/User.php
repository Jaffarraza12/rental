<?php
namespace App\Http\Model;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Model
{
    use EntrustUserTrait; // add this trait to your user model

}