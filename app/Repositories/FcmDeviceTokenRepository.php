<?php
namespace App\Repositories;

use Abedin\Boiler\Repositories\Repository;
use App\Models\FcmDeviceToken;

class FcmDeviceTokenRepository extends Repository
{
    public static function model()
    {
        return FcmDeviceToken::class;    
    }
}