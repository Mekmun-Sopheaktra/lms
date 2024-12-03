<?php
namespace App\Repositories;

use Abedin\Boiler\Repositories\Repository;
use App\Models\NotificationInstance;

class NotificationInstanceRepository extends Repository
{
    public static function model()
    {
        return NotificationInstance::class;    
    }
}