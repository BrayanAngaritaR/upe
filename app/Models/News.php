<?php

namespace App\Models;

use App\Models\News;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class News extends Model
{

    protected $fillable = [
        'from',
        'to',
        'color',
        'description',
        'created_by',
    ];

    public static function getAllNews()
    {
        $today = date('Y-m-d');

        $news = News::select('color', 'description')->where('from', '<=', $today)->where('to', '>=', $today)->where('created_by', Auth::user()->getCreatedBy())->where('status', '=', '0')->get();
        
        return $news;
    }
}
