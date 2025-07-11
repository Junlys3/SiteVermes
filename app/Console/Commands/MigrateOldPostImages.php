<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use App\Models\Posts;

class MigrateOldPostImages extends Command
{
    protected $signature = 'migrate:old-images';
    protected $description = 'Copia imagens de storage/app/public/posts para public/uploads e atualiza o campo imagem';

    public function handle()
    {
        // Garante que a pasta uploads existe
        $uploadsDir = public_path('uploads');
        if (!File::exists($uploadsDir)) {
            File::makeDirectory($uploadsDir, 0755, true);
            $this->info("Criada pasta public/uploads");
        }

        $posts = Posts::whereNotNull('imagem')->get();
        foreach ($posts as $post) {
            $oldRelPath = $post->imagem; // ex: posts/xyz.jpg
            $oldFullPath = storage_path('app/public/' . $oldRelPath);
            if (File::exists($oldFullPath)) {
                $filename = basename($oldRelPath);
                $newRelPath = 'uploads/' . $filename;
                $newFullPath = public_path($newRelPath);

                // Copia o arquivo
                File::copy($oldFullPath, $newFullPath);
                // Atualiza o banco
                $post->imagem = $newRelPath;
                $post->save();

                $this->info("Migrated {$oldRelPath} → {$newRelPath}");
            } else {
                $this->warn("Arquivo não encontrado: {$oldFullPath}");
            }
        }

        $this->info("Migração de imagens antigas concluída.");
    }
}
