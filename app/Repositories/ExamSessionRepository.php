<?php
namespace App\Repositories;

use Abedin\Boiler\Repositories\Repository;
use App\Models\ExamSession;

class ExamSessionRepository extends Repository
{
    public static function model()
    {
        return ExamSession::class;    
    }
}