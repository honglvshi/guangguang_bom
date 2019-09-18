<?php
namespace GuangBom;
class Directory
{
    public static function checkDirIsExist($dirPath)
    {
        return (is_dir($dirPath)) ? true : false;
    }

    /**
     * @param $dirPath
     * @return array
     */
    public static function scanDir($dirPath, &$fileList = []): array
    {
        $handler = opendir($dirPath);

        while (($file = readdir($handler)) !== false) {
            if ($file == '.' || $file == '..') {
               continue;
            }
            $childrenDir = $dirPath . DIRECTORY_SEPARATOR . $file;
            if (self::checkDirIsExist($childrenDir)) {
                self::scanDir($childrenDir, $fileList);
            } else {
                $fileList[] = $childrenDir;
            }
        }

        closedir($handler);

        return $fileList;
    }
}
