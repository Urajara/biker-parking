<nav class="navbar header-navbar">
    <div class="container-fluid">
        <div class="navbar-header header-logo-section">
            <a href="javascript:void(0);" class="bars" style="color: var(--blanco-puro);"></a>
            <a class="brand-title" href="home">Pole Position</a> 
            <span class="brand-subtitle">Biker Parking</span>
        </div>
    </div>
</nav>

<section>
    <aside id="leftsidebar" class="sidebar" style="position: fixed; top: 0; left: 0; z-index: 11; padding-top: 70px; box-sizing: border-box; height: 100%;">
        
        <div class="user-info" style="padding: 10px 16px; border-bottom: 1px solid var(--gris-borde);">
            <div class="info-container">
                <div class="name" style="color: var(--rojo-carrera); font-weight: bold; letter-spacing: 0.5px; text-transform: uppercase;">
                    <i class="material-icons" style="vertical-align: middle; font-size: 18px;">motorcycle</i> Panel Control
                </div>
            </div>
        </div>
        
        <div class="menu" style="margin-top: 15px; height: calc(100vh - 190px); overflow-y: auto;">
            <ul class="list" style="list-style: none; padding: 0; margin: 0; padding-bottom: 60px;">
                <li class="header" style="padding: 10px 16px; font-size: 11px; color: var(--gris-texto); font-weight: 700; text-transform: uppercase; letter-spacing: 1px;">
                    Menú Navegacional
                </li>
                
                <li>
                    <a href="home" class="sidebar-link <?= (basename($_SERVER['PHP_SELF']) == 'home') ? 'active' : '' ?>">
                        <i class="material-icons">home</i>
                        <span>Home</span>
                    </a>
                </li>
                <li>
                    <a href="tasa_cambio" class="sidebar-link <?= (basename($_SERVER['PHP_SELF']) == 'tasa_cambio') ? 'active' : '' ?>">
                        <i class="material-icons">assessment</i>
                        <span>Gestionar Tasa de Cambio </span>
                    </a>
                </li>
                <li>
                    <a href="cliente" class="sidebar-link <?= (basename($_SERVER['PHP_SELF']) == 'cliente') ? 'active' : '' ?>">
                        <i class="material-icons">people</i>
                        <span>Gestionar Cliente</span>
                    </a>
                </li>
                <li>
                    <a href="moto" class="sidebar-link <?= (basename($_SERVER['PHP_SELF']) == 'moto') ? 'active' : '' ?>">
                        <i class="material-icons">directions_bike</i>
                        <span>Gestionar Vehiculo</span>
                    </a>
                </li>
                <li>
                    <a href="pago_ticket" class="sidebar-link <?= (basename($_SERVER['PHP_SELF']) == 'pago_ticket') ? 'active' : '' ?>">
                        <i class="material-icons">directions_bike</i>
                        <span>Gestionar ticket y pago</span>
                    </a>
                </li>
                <li>
                    <a href="reportes" class="sidebar-link <?= (basename($_SERVER['PHP_SELF']) == 'reportes') ? 'active' : '' ?>">
                        <i class="material-icons">assessment</i>
                        <span>Gestionar Reportes</span>
                    </a>
                </li>
                <li>
                    <a href="usuarios" class="sidebar-link <?= (basename($_SERVER['PHP_SELF']) == 'usuarios') ? 'active' : '' ?>">
                        <i class="material-icons">people</i>
                        <span>Registrar Usuarios</span>
                    </a>
                </li>
                <li>
                    <a href="" class="sidebar-link <?= (basename($_SERVER['PHP_SELF']) == '') ? 'active' : '' ?>">
                        <i class="material-icons">people</i>
                        <span></span>
                    </a>
                </li>
            </ul>
        </div>
        
        <div class="legal" style="position: absolute; bottom: 0; left: 0; width: 100%; padding: 12px 16px; background-color: var(--negro-asfalto); border-top: 1px solid var(--gris-borde); z-index: 12;">
            <div class="copyright" style="font-size: 11px; color: var(--gris-texto);">
                &copy; <a href="javascript:void(0);" style="color: var(--rojo-carrera); text-decoration: none; font-weight: bold;">Pole Position</a>
            </div>
            <div class="version" style="font-size: 11px; color: var(--gris-texto); margin-top: 2px;">
                <b>Versión: </b> 1.0
            </div>
        </div>
    </aside>
</section>

<script src="resources/library/plugins/jquery/jquery.min.js"></script>