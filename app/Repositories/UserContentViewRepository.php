<?php
namespace App\Repositories;

use Abedin\Boiler\Repositories\Repository;
use App\Models\UserContentView;

class UserContentViewRepository extends Repository
{
    public static function model()
    {
        return UserContentView::class;    
    }
}