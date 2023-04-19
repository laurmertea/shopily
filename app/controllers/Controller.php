<?php

namespace App\Controllers;

use App\Core\App;

class Controller
{
    /**
     * Return sorted data by given property in given direction.
     *
     * @param array $data
     * @param string $property
     * @param string $direction Direction can only be 'ASC' for ascending and 'DESC' for descending.
     * @return array
     */
    protected function sortBy(array $data, string $property, string $direction = 'ASC'): array
    {
        $allowed = ['ASC', 'DESC'];

        if (! in_array($direction, $allowed)) return $data;

        if ($direction === 'DESC') {
            usort($data, function ($a, $b) use ($property) {
                return $b->$property <=> $a->$property;
            });
        } else {
            usort($data, function ($a, $b) use ($property) {
                return $a->$property <=> $b->$property;
            });
        }

        return $data;
    }

    /**
     * Return the latest item.
     *
     * @param array $data
     * @return mixed
     */
    protected function latest(array $data)
    {
        $data = self::sortBy($data, 'modified_on', 'DESC');

        return ($data[0]) ?? null;
    }

    /**
     * Return the oldest item.
     *
     * @param array $data
     * @return mixed
     */
    protected function oldest(array $data)
    {
        $data = self::sortBy($data, 'modified_on', 'ASC');

        return ($data[0]) ?? null;
    }
}