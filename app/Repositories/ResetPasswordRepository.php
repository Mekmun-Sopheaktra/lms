<?php
namespace App\Repositories;

use Abedin\Boiler\Repositories\Repository;
use App\Models\ResetPassword;

class ResetPasswordRepository extends Repository
{
    public static function model()
    {
        return ResetPassword::class;    
    }
}