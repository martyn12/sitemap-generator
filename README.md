# Установка
Так как эта библиотека не опубликована на packagist, используем репозиторий. В вашем composer.json:
```bash
"require": {
    "martyn12/sitemap-generator": "dev-master"
},
"repositories": [
    {
        "type": "vcs",
        "url": "https://github.com/martyn12/sitemap-generator.git"
    }
],
```
После выполняем 
```bash
composer update
```

# Использование
Создаем экземпляр класса SitemapGenerator, в констуктор передаем массив с информацией о страницах, тип файла и путь для сохранения
```bash
<?php
require 'vendor/autoload.php';
use SitemapGenerator\SitemapGenerator;

$generator = new SitemapGenerator({your_sitemap_data}, 'csv', {your_storage_path} . '/sitemap.csv');
$generator->generate();
```