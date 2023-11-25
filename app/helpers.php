<?php

use App\Models\Category;
use App\Models\GenConfig;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

if (!function_exists('rank')) {
    function rank()
    {
        return \App\Models\Rank::find(1);
    }
}
if (!function_exists('rankTeam')) {
    function rankTeam()
    {
        return User::join('type_users', 'users.type_user_id', '=', 'type_users.id')
            ->join('fonctions', 'users.fonction_id', '=', 'fonctions.id')
            ->where('type_users.name', '!=', 'membre simple')
            ->where('users.fonction_id', '!=', '')
            ->orderBy('id','DESC')
            ->select('users.*')
            ->get();

    }
}
if (!function_exists('about')) {
    function about()
    {
        return \App\Models\About::find(1);
    }
}
if (!function_exists('siteInfos')) {
    function siteInfos()
    {
        return GenConfig::find(1);
    }
}

if (!function_exists('LatestPost')) {
    function LatestPost()
    {
        return \App\Models\Post::where('approved',1)->latest()->first();
    }
}

/** lastgalerie */
if (!function_exists('LatestGaleries')) {
    function LatestGaleries()
    {
        return \App\Models\Galery::latest()->take(6)->get();
    }
}


/**
 * categories globales
 */

if (!function_exists('categories')){
    function categories(){
        return Category::withCount('posts')->orderBy('posts_count')->get();
    }

}

if (!function_exists('relatedPosts')){
    function relatedPosts(){
        return Post::where('approved',1)->with(['category', 'image'])
            ->whereHas('category', function ($query) {
                $query->where('name', LatestPost()?LatestPost()->category->name:'');
            })
            ->get();
    }

}

if (!function_exists('LatestPosts')){
    function LatestPosts(){
        return Post::latest()->where('approved',1)->with(['author','image','category'])->orderBy('id','DESC')->take(5)->get();
    }

}


if (!function_exists('words')){
    function words($value,$length=15, $end="..."){
        return Str::words(strip_tags($value),$length,$end);
    }
}
