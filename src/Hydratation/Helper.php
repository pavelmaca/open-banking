<?php
declare(strict_types=1);


namespace PavelMaca\OpenBanking\Hydratation;

abstract class Helper
{
    public static function readValueFromArrayByPath(array $path, array $array)
    {
        $tmp = $array;
        foreach ($path as $key) {
            $tmp = $tmp[$key] ?? null;
        }
        return $tmp;
    }

    public static function setValueIntoArrayByPath(array $path, $value, array $array): array
    {
        // current level
        $tmp = &$array;
        foreach ($path as $i => $key) {
            end($path);
            $isLast = key($path) === $i;

            if (!$isLast && !isset($tmp[$key])) {
                $tmp[$key] = [];
            }

            if ($isLast) {
                $tmp[$key] = $value;
            }

            // next level of nasted array
            $tmp = &$tmp[$key];
        }
        unset($tmp);
        return $array;
    }
}
