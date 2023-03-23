<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ArticleSeeder extends Seeder
{
    public function run()
    {
        $articles = [
            [
                'name'         => 'Articulo 1',
                'description' => 'Descripcion del articulo 1',
                'locale' => 'es',
            ],
            [
                'name'         => 'Articulo 2',
                'description' => 'Descripcion del articulo 2',
                'locale' => 'es',
            ],
            [
                'name'         => 'Articulo 3',
                'description' => 'Descripcion del articulo 3',
                'locale' => 'es',
            ],
            [
                'name'         => 'Articulo 4',
                'description' => 'Descripcion del articulo 4',
                'locale' => 'es',
            ],
            [
                'name'         => 'Articulo 5',
                'description' => 'Descripcion del articulo 5',
                'locale' => 'es',
            ],

        ];
        $builder = $this->db->table('articles');
        $builder->insertBatch($articles);
    }
}
