<?php
namespace App\Repositories;

use Abedin\Boiler\Repositories\Repository;
use App\Models\Transaction;

class TransactionRepository extends Repository
{
    public static function model()
    {
        return Transaction::class;    
    }
}