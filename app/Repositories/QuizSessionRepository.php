<?php
namespace App\Repositories;

use Abedin\Boiler\Repositories\Repository;
use App\Models\QuizSession;

class QuizSessionRepository extends Repository
{
    public static function model()
    {
        return QuizSession::class;    
    }
}