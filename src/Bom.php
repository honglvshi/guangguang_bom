<?php

namespace GuangBom;

use Dariuszp\CliProgressBar;

class Bom
{
    private $config = [
        "check_extension" => ['php'],
        "check_path" => []
    ];

    private $boomCount = 0;
    private $boomFile = [];

    public function __construct(array $config = [])
    {
        $this->config = array_merge($this->config, $config);
    }

    public function find(bool $isRemoveBomHeader = false)
    {
        foreach ($this->config['check_path'] as $path) {
            if (!Directory::checkDirIsExist($path)) {
                throw new \Exception("{$path} is not a correct directory");
            }

            echo "{$path}" . PHP_EOL;
            $fileList = Directory::scanDir($path);

            $bar = new CliProgressBar(count($fileList), 0);

            foreach ($fileList as $file) {
                if (File::checkFileBom($file, $isRemoveBomHeader)) {
                    $this->boomCount++;
                    $this->boomFile[] = $file;
                }

                $bar->progress();
            }
            $bar->display();
            echo PHP_EOL;
        }

        $this->showResult();
    }

    private function showResult()
    {
        echo PHP_EOL;
        echo "bom文件数量:" . $this->boomCount . PHP_EOL;
        if ($this->boomCount > 0) {
            echo "bom文件位置:" . PHP_EOL;
            foreach ($this->boomFile as $bom) {
                echo $bom . PHP_EOL;
            }
        }

    }

}
