<?php

namespace App\Entities;

use App\Traits\Translations;
use CodeIgniter\Entity\Entity;

class ArticleEntity extends Entity{

    use Translations;

    protected $table  = 'articles';
    
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];

    public function getName(){
        return $this->translation('name', $this->attributes['name']);
    }
    public function getDescription(){
        return $this->translation('description', $this->attributes['description']);
    }
}
