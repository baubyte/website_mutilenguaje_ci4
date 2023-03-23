<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TranslationsSeeder extends Seeder
{
    public function run()
    {
        $translations = [
            [
                "table" => "articles",
                "column" => "name",
                "translation" => "Article One",
                "locale" => "en",
                "table_id" => "1",
            ],
            [
                "table" => "articles",
                "column" => "description",
                "translation" => "Description of article one",
                "locale" => "en",
                "table_id" => "1",
            ],
            [
                "table" => "articles",
                "column" => "name",
                "translation" => "Article Two",
                "locale" => "en",
                "table_id" => "2",
            ],
            [
                "table" => "articles",
                "column" => "description",
                "translation" => "Description of article two",
                "locale" => "en",
                "table_id" => "2",
            ],
            [
                "table" => "articles",
                "column" => "name",
                "translation" => "Article Three",
                "locale" => "en",
                "table_id" => "3",
            ],
            [
                "table" => "articles",
                "column" => "description",
                "translation" => "Description of article three",
                "locale" => "en",
                "table_id" => "3",
            ],
            [
                "table" => "articles",
                "column" => "name",
                "translation" => "Article Four",
                "locale" => "en",
                "table_id" => "4",
            ],
            [
                "table" => "articles",
                "column" => "description",
                "translation" => "Description of article four",
                "locale" => "en",
                "table_id" => "4",
            ],
            [
                "table" => "articles",
                "column" => "name",
                "translation" => "Article Five",
                "locale" => "en",
                "table_id" => "5",
            ],
            [
                "table" => "articles",
                "column" => "description",
                "translation" => "Description of article five",
                "locale" => "en",
                "table_id" => "5",
            ],

        ];
        $builder = $this->db->table('translations');
        $builder->insertBatch($translations);
    }
}
