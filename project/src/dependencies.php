<?php

use Pimple\Container;
use Monolog\Logger;

$container = new Container();

//Whoops & Monolog
$container[Logger::class] = static function (Container $container) {
    require_once __DIR__ . DIRECTORY_SEPARATOR . 'logger.php';
    /** @var \Monolog\Logger $logger */
    return $logger;
};

$container[PDO::class] = static function (Container $c) {
    try {
        $dbh = new PDO(
            'mysql:dbname=' . $_ENV['DBNAME'] . ';host=' . $_ENV['DBHOST'],
            $_ENV['DBUSERNAME'],
            $_ENV['DBPASSWD']
        );

        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch (PDOException $e) {
        $logger->alert('Database connection failed');
        die("Database connection failed");
    }

    return $dbh;
};

$container[\App\DataProvider\ProductDataProvider::class] = static function (Container $container) {
    return new \App\DataProvider\ProductDataProvider(
        $container[PDO::class],
        $container[\App\Hydrator\ProductHydrator::class]
    );
};

$container[\App\DataProvider\CheckInDataProvider::class] = static function (Container $container) {
    return new \App\DataProvider\CheckInDataProvider(
        $container[PDO::class],
        $container[\App\Hydrator\CheckInHydrator::class]
    );
};

$container[\App\DataProvider\UserDataProvider::class] = static function (Container $container) {
    return new \App\DataProvider\UserDataProvider(
        $container[PDO::class],
        $container[\App\Hydrator\UserHydrator::class]
    );
};

$container[\App\Hydrator\CheckInHydrator::class] = static function (Container $container) {
    return new \App\Hydrator\CheckInHydrator(
        $container[\App\Entity\CheckIn::class]
    );
};

$container[\App\Hydrator\ProductHydrator::class] = static function (Container $container) {
    return new \App\Hydrator\ProductHydrator(
        $container[\App\Entity\Product::class],
        $container[\App\Hydrator\CheckInHydrator::class]
    );
};

$container[\App\Hydrator\UserHydrator::class] = static function (Container $container) {
    return new \App\Hydrator\UserHydrator(
        $container[\App\Entity\User::class],
    );
};

$container[\App\Entity\CheckIn::class] = static function (Container $container) {
    return new \App\Entity\CheckIn();
};

$container[\App\Entity\Product::class] = static function (Container $container) {
    return new \App\Entity\Product();
};

$container[\App\Entity\User::class] = static function (Container $container) {
    return new \App\Entity\User();
};

