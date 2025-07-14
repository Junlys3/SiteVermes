<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\posts;


class PostDetails extends Controller
{
    public function PostDetails($id)
    {
        $post = posts::findOrFail($id);
        return view('site.postdetails', compact('post'));
    }
}
