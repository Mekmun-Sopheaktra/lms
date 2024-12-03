<?php
namespace App\Repositories;

use Abedin\Boiler\Repositories\Repository;
use App\Models\Guest;

class GuestRepository extends Repository
{
    public static function model()
    {
        return Guest::class;    
    }
}