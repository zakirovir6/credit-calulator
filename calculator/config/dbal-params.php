<?php

/** @var \Symfony\Component\DependencyInjection\Container */
$container->setParameter('mysql_database', getenv('MYSQL_DATABASE'));
$container->setParameter('mysql_host', getenv('MYSQL_HOST'));
$container->setParameter('mysql_port', getenv('MYSQL_PORT'));
$container->setParameter('mysql_user', getenv('MYSQL_USER'));
$container->setParameter('mysql_password', getenv('MYSQL_PASSWORD'));