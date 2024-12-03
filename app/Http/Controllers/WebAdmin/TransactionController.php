<?php

namespace App\Http\Controllers\WebAdmin;

use App\Http\Controllers\Controller;
use App\Repositories\TransactionRepository;

class TransactionController extends Controller
{
    public function index()
    {
        return view('transaction.index', [
            'transactions' => TransactionRepository::query()->latest('id')->get(),
        ]);
    }
}
