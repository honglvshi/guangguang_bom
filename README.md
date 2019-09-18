
###安装
```
composer require honglvshi/guangguang_bom
```
### demo
```
//check_extension 检测文件的后缀
//check_path检测的目录
$ret = new \GuangBom\Bom([
    "check_extension" => ['php'],   
    "check_path" => [__DIR__,__DIR__]
]);

//true 代表直接替换bom头 false 只查找 默认flase
$ret->find(true);

```

