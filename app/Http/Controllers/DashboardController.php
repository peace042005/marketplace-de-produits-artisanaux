<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
         $to = Article::count();
          $totalSales = Article::sum('total');
           return view('Janvier/dashboard', compact('to'));
        }
}
