<?php

namespace MccMncExtractor;

use DiDom\Document;

/**
 * Class MccMncExtractor
 * @package MccMncExtractor
 */
class MccMncExtractor
{
    /**
     * URL to be fetched
     *
     * @var string
     */
    static public $url = 'http://mcc-mnc.com/';

    /**
     * Data Map
     * @var array
     */
    static public $map = [
        0 => 'mmc',
        1 => 'mnc',
        2 => 'country_iso',
        3 => 'country_name',
        4 => 'country_code',
        5 => 'network',
    ];

    /**
     * Main method, extract data from self::$url
     *
     * @return array
     */
    static public function extract()
    {
        try {
            $result = [];
            $document = @new Document(self::$url, true);
            $lines = $document
                ->find('tbody')[0]
                ->find('tr');
            foreach ($lines as $line) {
                $columns = $line->find('td');
                $current = [];
                foreach ($columns as $column) {
                    $index = count($current);
                    $current[self::$map[$index]] = $column->text();
                }
                $result[] = $current;
            }
            return $result;
        } catch (\Exception $e) {
            return [
                'error' => true,
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ];
        }
    }
}