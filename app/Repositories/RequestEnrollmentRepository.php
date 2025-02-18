<?php
namespace App\Repositories;

use Abedin\Boiler\Repositories\Repository;
use App\Models\RequestEnrollment;

class RequestEnrollmentRepository extends Repository
{
    public static function model()
    {
        return RequestEnrollment::class;    
    }
}