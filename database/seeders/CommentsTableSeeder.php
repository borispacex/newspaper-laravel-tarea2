<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comment;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Elimina todos los registros existentes en la tabla antes de agregar nuevos datos
        Comment::truncate();

        // Agrega datos de ejemplo
        Comment::create([
            'text' => 'Lima sugiere otro referéndum para “despedir” a Evo Morales',
            'sending_date' => 20240221,
            'publication_date' => 20240223,
            'status' => 'PUBLISHED',
            'content_id' => 1,
            'user_id' => 1,
            'created_by' => 'seeder'
        ]);

        // Método factory para generar datos de ejemplo más complejos
        Comment::factory(10)->create(); 
    }
}
