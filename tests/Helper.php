<?php
declare(strict_types=1);


namespace PavelMaca\OpenBanking\Test;

class Helper
{
    public static function filterArrayRecursive(array $array): array
    {
        foreach ($array as $k => $value) {
            if (is_array($value)) {
                $subArray = self::filterArrayRecursive($value);
                if (empty($subArray)) {
                    unset($array[$k]);
                } else {
                    $array[$k] = $subArray;
                }
            }
            if (is_null($value)) {
                unset($array[$k]);
            }
        }
        return $array;
    }
}
