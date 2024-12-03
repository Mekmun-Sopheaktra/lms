<?php
namespace App\Repositories;

use Abedin\Boiler\Repositories\Repository;
use App\Models\Article;

class ArticleRepository extends Repository
{
    public static function model()
    {
        return Article::class;    
    }
}