<?php

namespace App\Http\Controllers;;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class uploadToSupabase extends Controller
{


public function uploadToSupabase(Request $request)
{
    $request->validate([
        'imagem' => 'required|image|max:2048',
    ]);

    $file = $request->file('imagem');
    $fileContent = file_get_contents($file->getPathname());
    $fileName = uniqid() . '.' . $file->getClientOriginalExtension();

    $response = Http::withHeaders([
        'apikey' => env('SUPABASE_KEY'),
        'Authorization' => 'Bearer ' . env('SUPABASE_KEY'),
        'Content-Type' => $file->getMimeType(),
    ])->put(env('SUPABASE_URL') . "/storage/v1/object/{$request->bucket}/{$fileName}", $fileContent);

    if ($response->successful()) {
        // Aqui você pode salvar o $fileName no banco, por exemplo:
        // Post::create([... 'imagem' => $fileName ...]);

        return back()->with('success', 'Upload feito com sucesso!')->with('file_path', $fileName);
    } else {
        return back()->withErrors(['upload' => 'Erro ao fazer upload.']);
    }
}

}
