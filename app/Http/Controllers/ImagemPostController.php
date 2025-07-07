<?php

namespace App\Http\Controllers;



use App\Models\ImagemPost;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;



class ImagemPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$imagemPost = ImagemPost::paginate(2);

        //return view('site.posts', compact('imagemPost'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ImagemPost $imagemPost)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ImagemPost $imagemPost)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ImagemPost $imagemPost)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ImagemPost $imagemPost)
    {
        //
    }
}
