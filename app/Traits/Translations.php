<?php
namespace App\Traits;

use App\Models\Settings\TranslationModel;
use Exception;

trait Translations{

    /**
     * Get translation for column
     *
     * @param string $column
     * @param string $default
     * @return string
     */
    public function translation($column, $default = '', $table = null): string{

        if (!property_exists($this, 'table') && is_null($table)) {
            throw new Exception('Table property not found or table not passed');
        }
        $table = $table ?? $this->table;
        $locale = service('language')->getLocale();
        $cacheName = "translation_{$table}_{$column}_{$this->attributes['id']}_{$locale}";


        if($this->locale === $locale){
            return $default;
        }
        if (null === $translation = cache("{$cacheName}")) {
            $translation = (new TranslationModel)->where([
                'table' => $table,
                'column' => $column,
                'table_id' => $this->attributes['id'],
                'locale' => $locale
            ])->get()->getRow();
            cache()->save("{$cacheName}", $translation, 600);
        }

        return $translation->translation ?? $default;
    }
}