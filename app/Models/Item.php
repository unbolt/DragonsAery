<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Item extends Model
{
    use \Sushi\Sushi;

    private $rows = [];

    protected $schema = [
        'int_id' => 'integer',
        'flags' => 'integer',
        'stack_size' => 'integer',
        'type' => 'integer',
        'resource_id' => 'integer',
        'valid-targets' => 'integer',
        'en_name' => 'string',
        'jp_name' => 'string',
        'fr_name' => 'string',
        'de_name' => 'string',
        'en_description' => 'string',
        'jp_description' => 'string',
        'fr_description' => 'string',
        'de_description' => 'string',
        'log_name_singular' => 'string',
        'log_name_plural' => 'string',
        'level' => 'integer',
        'slots' => 'integer',
        'races' => 'integer',
        'jobs' => 'integer',
        'shield_size' => 'integer',
        'max_charges' => 'integer',
        'casting_time' => 'integer',
        'use_delay' => 'integer',
        'reuse_delay' => 'integer',
        'element' => 'integer',
        'storage-slots' => 'integer',
        'damage' => 'integer',
        'delay' => 'integer',
        'dps' => 'integer',
        'skill' => 'integer',
        'jug_size' => 'integer',
        'puppet_slot' => 'integer',
        'element_charge' => 'integer',
        'rare' => 'integer',
        'ex' => 'integer',
        'relic' => 'integer',
        'notes' => 'string',
        'item_level' => 'integer',
        'superior_level' => 'integer',
    ];

    public function getRows()
    {
        $this->rows = $this->populateItemData();

        return $this->rows;

    }

    private function populateItemData() 
    {
        return Cache::remember('items', '999999', function () {
            return $this->getItemData();
        });
    }

    private function getItemData() 
    {
        $string = file_get_contents(storage_path('app/data/items.xml'), "r");
        $string = str_replace('&', '&amp;', $string);
        $xml = simplexml_load_string($string);
        $array = json_decode(json_encode((array)$xml), TRUE);

        $items = array();

        foreach($array['item'] as $item) {
            foreach($item as $k => $v) {
                if(gettype($v) == 'array') {
                    $item[$k] = '';
                }
            }
            $items[] = $item;
        }

        return $items;
    }
}
