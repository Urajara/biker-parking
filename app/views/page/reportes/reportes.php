<section class="content">
    <div class="container-fluid">
        <input type="hidden" id="id_usuario_sesion" value="1">

        <div class="block-header">
            <h2 style="font-weight: bold; color: #333;">REPORTE DE CAJA DIARIA</h2>
        </div>

        <div class="row clearfix">
            
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="info-box-2" style="background: #fff; border-left: 5px solid #d32f2f; box-shadow: 0 2px 10px rgba(0,0,0,0.05); min-height: 100px;">
                    <div class="icon" style="padding: 10px 0;"><i class="material-icons" style="color: #d32f2f; font-size: 45px;">motorcycle</i></div>
                    <div class="content" style="padding-left: 15px;">
                        <div class="text" style="color: #555; font-weight: bold; margin-top: 5px;">TOTAL MOTOS HOY</div>
                        <div class="number" id="lbl_total_motos" style="color: #111; font-size: 24px; font-weight: bold;">0</div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="info-box-2" style="background: #fff; border-left: 5px solid #d32f2f; box-shadow: 0 2px 10px rgba(0,0,0,0.05); min-height: 100px;">
                    <div class="icon" style="padding: 10px 0;"><i class="material-icons" style="color: #4CAF50; font-size: 45px;">attach_money</i></div>
                    <div class="content" style="padding-left: 15px;">
                        <div class="text" style="color: #555; font-weight: bold; margin-top: 5px;">RECAUDOS DEL DÍA</div>
                        <div class="number" id="lbl_ganancia_total" style="color: #4CAF50; font-size: 24px; font-weight: bold;">0.00 $</div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="info-box-2" style="background: #fff; border-left: 5px solid #d32f2f; box-shadow: 0 2px 10px rgba(0,0,0,0.05); min-height: 100px;">
                    <div class="icon" style="padding: 10px 0;"><i class="material-icons" style="color: #2196F3; font-size: 45px;">trending_up</i></div>
                    <div class="content" style="padding-left: 15px;">
                        <div class="text" style="color: #555; font-weight: bold; margin-top: 5px;">TASA DEL DÍA</div>
                        <div class="number" id="lbl_tasa_dia" style="color: #2196F3; font-size: 24px; font-weight: bold;">0.00 Bs</div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card" style="box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
                    <div class="header" style="border-top: 4px solid #d32f2f; background: #fff;">
                        <h2 style="color: #333; font-weight: bold;">
                            Ocupación Especificada por Zonas
                            <small style="color: #888;">Resumen detallado de la cantidad de vehículos ingresados hoy en cada sector</small>
                        </h2>
                    </div>
                    
                    <div class="body table-responsive">
                        <table class="table table-hover table-striped" id="tablaReporteZonas">
                            <thead>
                                <tr style="color: #d32f2f; font-weight: bold;">
                                    <th><i class="material-icons" style="font-size: 18px; vertical-align: middle;">layers</i> Zona de Estacionamiento</th>
                                    <th><i class="material-icons" style="font-size: 18px; vertical-align: middle;">confirmation_number</i> Total Motos Registradas</th>
                                </tr>
                            </thead>
                            <tbody id="tablaZonas">
                                <tr>
                                    <td colspan="2" class="text-center" style="color: #888;">Cargando información del día...</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'app/views/page/reportes/modal.php'; ?>

<script src="resources/library/plugins/jquery/jquery.min.js"></script>
<script src="public/js/reportes.js"></script>