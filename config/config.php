<?php

if ( !isset( $_SESSION ) ) { session_start(); }
if ( isset($_SESSION['database']) ) {

  $database = $_SESSION['database'];
} else {

  // Si existe la variable en Render, usa el nombre de la BD en la nube, de lo contrario usa 'estacionamiento'
  $database = getenv("DB_NAME") ?: 'estacionamiento';
    // $database = 'educativo';
}

$databaseAnterior = 'baseAntigua';

$config = [

    "database" => [
      // Si existe DB_DRIVER en Render usa 'pgsql', de lo contrario mantiene 'mysql' de tu XAMPP
      "driver"     => getenv("DB_DRIVER") ?: "mysql",
      // Si existe DB_HOST en Render usa el host de la nube, de lo contrario mantiene 'localhost'
      "host"       => getenv("DB_HOST") ?: "localhost",
      // Si existe DB_PORT usa '5432' de Render, de lo contrario mantiene '3306' de MySQL
      "port"       => getenv("DB_PORT") ?: "3306",
      "dbname"     => $database,
      // Si existe DB_USER usa el usuario de Render, de lo contrario mantiene 'root'
      "username"   => getenv("DB_USER") ?: "root",
      // Si existe DB_PASSWORD usa la clave larga de Render, de lo contrario mantiene vacío ""
      "password"   => getenv("DB_PASSWORD") !== false ? getenv("DB_PASSWORD") : ""
      
      /* CONFIGURACIÓN ANTERIOR FIJA (COMENTADA POR SEGURIDAD)
      "driver"     => "mysql",
      "host"       => "localhost",
      "port"       => "3306",
      "dbname"     => $database,
      "username"   => "root",
      "password"   => ""
      */
    ],
    "mailer" => [

      "smtp_debug"      => false,
      "host"            => "smtp.gmail.com",
      "smtp_auth"       => true,
      "username"        => "correo@gmail.com",
      "password"        => "123456",
      "smtp_secure"     => "ssl",
      "port"            => 465,
      "reply_to_email"  => "correo@gmail.com",
      "reply_to_name"   => "Uptaeb",
      "from_email"      => "correo@gmail.com",
      "from_name"       => "Uptaeb"
    ],
];

$configAnterior = [

    "database" => [

      "driver"     => "mysql",
      "host"       => "localhost",
      "port"       => "3306",
      "dbname"     => $databaseAnterior,
      "username"   => "root",
      "password"   => ""
    ],
    "mailer" => [

      "smtp_debug"      => false,
      "host"            => "smtp.gmail.com",
      "smtp_auth"       => true,
      "username"        => "correo@gmail.com",
      "password"        => "123456",
      "smtp_secure"     => "ssl",
      "port"            => 465,
      "reply_to_email"  => "correo@gmail.com",
      "reply_to_name"   => "Uptaeb",
      "from_email"      => "correo@gmail.com",
      "from_name"       => "Uptaeb"
    ],
];