<section class="content">
    <div class="container-fluid">
        
        <!-- BANNER DE BIENVENIDA -->
        <div class="row clearfix">
            <div class="col-xs-12">
                <div class="info-banner" style="background-color: #e61922; color: #ffffff; padding: 20px; border-radius: 4px; margin-bottom: 25px;">
                    <h2 style="margin: 0; font-size: 24px; font-weight: 700;">Bienvenido</h2>
                    <p style="margin: 5px 0 0 0; opacity: 0.9;">Biker Parking Pole Position</p>
                </div>
            </div>
        </div>

        <!-- SECCIÓN DE INDICADORES EN VIVO (Motos y Estado) -->
        <div class="row clearfix">
            
            <!-- Tarjeta 1: Cupos Disponibles -->
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div style="background: #fff; min-height: 80px; border-left: 4px solid #e61922; box-shadow: 0 2px 5px rgba(0,0,0,0.05); display: flex; align-items: center; padding: 15px; margin-bottom: 20px;">
                    <div style="margin-right: 15px; color: #e61922; display: flex; align-items: center;">
                        <i class="material-icons" style="font-size: 32px;">local_parking</i>
                    </div>
                    <div>
                        <div style="font-size: 11px; color: #777; text-transform: uppercase; font-weight: 600;">Cupos Disponibles</div>
                        <div style="font-size: 18px; font-weight: bold; color: #333;">24 / 50</div>
                    </div>
                </div>
            </div>

            <!-- Tarjeta 2: Ingresos Última Hora -->
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div style="background: #fff; min-height: 80px; border-left: 4px solid #333; box-shadow: 0 2px 5px rgba(0,0,0,0.05); display: flex; align-items: center; padding: 15px; margin-bottom: 20px;">
                    <div style="margin-right: 15px; color: #333; display: flex; align-items: center;">
                        <i class="material-icons" style="font-size: 32px;">access_time</i>
                    </div>
                    <div>
                        <div style="font-size: 11px; color: #777; text-transform: uppercase; font-weight: 600;">Ingresos (Última Hora)</div>
                        <div style="font-size: 18px; font-weight: bold; color: #333;">8 Motos</div>
                    </div>
                </div>
            </div>

            <!-- Tarjeta 3: Estado del Servidor -->
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div style="background: #fff; min-height: 80px; border-left: 4px solid #2e7d32; box-shadow: 0 2px 5px rgba(0,0,0,0.05); display: flex; align-items: center; padding: 15px; margin-bottom: 20px;">
                    <div style="margin-right: 15px; color: #2e7d32; display: flex; align-items: center;">
                        <i class="material-icons" style="font-size: 32px;">check_circle</i>
                    </div>
                    <div>
                        <div style="font-size: 11px; color: #777; text-transform: uppercase; font-weight: 600;">Estado del Servidor</div>
                        <div style="font-size: 18px; font-weight: bold; color: #2e7d32;">En Línea</div>
                    </div>
                </div>
            </div>

        </div>

        <!-- TABLA DE OCUPACIÓN DE BAHÍAS -->
        <div class="row clearfix">
            <div class="col-xs-12">
                <div class="card" style="background: #fff; border-radius: 4px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); border: none;">
                    <div class="header" style="padding: 15px 20px; border-bottom: 1px solid #f0f0f0; display: flex; align-items: center; gap: 10px;">
                        <i class="material-icons" style="color: #e61922; font-size: 20px; vertical-align: middle;">motorcycle</i>
                        <h2 style="margin: 0; font-size: 16px; font-weight: 600; color: #333; display: inline-block;">Monitoreo de Bahías Activas</h2>
                    </div>
                    <div class="body" style="padding: 20px;">
                        <div class="table-responsive">
                            <table class="table table-hover" style="margin-bottom: 0; font-size: 14px; width: 100%;">
                                <thead>
                                    <tr style="background: #fafafa; color: #666;">
                                        <th>Zona de Estacionamiento</th>
                                        <th class="text-center">Capacidad</th>
                                        <th class="text-right">Estatus</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><strong>Zona 1 - Empleado Centro Comercial</strong></td>
                                        <td class="text-center">15 / 20</td>
                                        <td class="text-right"><span class="label" style="background-color: #2e7d32; padding: 4px 8px; color: #fff; font-size: 11px; border-radius: 2px;">Disponible</span></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Zona 2 - Motos Paseo</strong></td>
                                        <td class="text-center">12 / 15</td>
                                        <td class="text-right"><span class="label" style="background-color: #2e7d32; padding: 4px 8px; color: #fff; font-size: 11px; border-radius: 2px;">Disponible</span></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Zona 3 - Motos Enduro</strong></td>
                                        <td class="text-center">10 / 10</td>
                                        <td class="text-right"><span class="label" style="background-color: #c62828; padding: 4px 8px; color: #fff; font-size: 11px; border-radius: 2px;">Completo</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>