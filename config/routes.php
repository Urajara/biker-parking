<?php

    # _____________ Configuración de rutas del sistema ________________________
    # acción recibida por $_GET['action']
    # ['*'] para acceso público.

return [
    'index' => [
        'vista' => 'login.php',
        'menu'  => false,
        'roles' => ['*']
    ],
    'home' => [
        'vista' => 'home.php',
        'menu'  => true,
        // 'roles' => ['admin', 'usuario']
        'roles' => ['*']
    ],
    'usuarios' => [
        'vista' => 'usuarios/usuarios.php',
        'menu'  => true,
        'roles' => ['*']
    ],
    'reportes' => [
        'vista' => 'reportes/reportes.php',
        'menu'  => true,
        'roles' => ['*', 'supervisor']
    ],
    'cliente' => [
        'vista' => 'cliente/cliente.php',
        'menu'  => true,
        'roles' => ['*', 'supervisor']
    ],
    'moto' => [
        'vista' => 'moto/moto.php',
        'menu'  => true,
        'roles' => ['*', 'supervisor']
    ],
    'pago_ticket' => [
        'vista' => 'pago_ticket/pago_ticket.php',
        'menu'  => true,
        'roles' => ['*', 'supervisor']
    ],
    'tasa_cambio' => [
        'vista' => 'tasa_cambio/tasa_cambio.php',
        'menu'  => true,
        'roles' => [ 'gerente']
    ],
        
        
];