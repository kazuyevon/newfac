<?php
namespace newfac\inc;
/*
 * #src\inc\misc.php
 * This file is part of the newfac package.
 *
 * (c) Fabrice Thiebaut <kazuyevon@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

// \PDO puisque PDO est extérieur à la source en utilisant les namespaces

// Database
define ( 'DSN', 'mysql:host=127.0.0.1:3388;dbname=dbfacture' );
define ( 'USERNAME', 'dbaccess' );
define ( 'PASSWORD', 'dbaccess' );
/*serialize() pour être compatible avec php 5.4.31, sinon avec php 7.2.4, il n'est pas utile.*/
define ( 'OPTIONS', serialize(array(\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8', \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION) ));