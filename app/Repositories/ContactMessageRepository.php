<?php
namespace App\Repositories;

use Abedin\Boiler\Repositories\Repository;
use App\Models\ContactMessage;

class ContactMessageRepository extends Repository
{
    public static function model()
    {
        return ContactMessage::class;    
    }
}