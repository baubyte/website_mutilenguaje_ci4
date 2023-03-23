<?php
namespace App\Traits;

use App\Models\Settings\TranslationModel;

trait Translations{

    /**
     * Undocumented function
     *
     * @param string $column
     * @param string $default
     * @return string
     */
    public function translation($column, $default = ''): string{
        $locale = service('language')->getLocale();


        if($this->locale === $locale){
            return $default;
        }

        $translation = (new TranslationModel)->where([
            'table' => $this->table,
            'column' => $column,
            'table_id' => $this->attributes['id'],
            'locale' => $locale
        ])->first();
        
        if($translation){
            return $translation->translation;
        }else{
            return $default;
        }
    }
}