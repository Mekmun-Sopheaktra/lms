<?php
namespace App\Repositories;

use Abedin\Boiler\Repositories\Repository;
use App\Models\AccountActivation;

class AccountActivationRepository extends Repository
{
    public static function model()
    {
        return AccountActivation::class;    
    }
}