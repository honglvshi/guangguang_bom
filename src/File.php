<?php

namespace GuangBom;
class File
{
    public static function checkFileBom(string $filePath, bool $isRemove)
    {
        if (!is_file($filePath)) {
            return false;
        }

        $contents = file_get_contents($filePath);

        $result = self::checkBom(
            substr($contents, 0, 1),
            substr($contents, 1, 2),
            substr($contents, 2, 3),
            );

        if (!$isRemove) {
            return $result;
        }

        if ($result) {
            return file_put_contents($filePath, substr($contents, 3));

        }
    }


    private static function checkBom($header1, $header2, $header3)
    {
        if (ord($header1) == 239 && ord($header2) == 187 && ord($header3) == 191) {
            return true;
        }
        return false;
    }
}