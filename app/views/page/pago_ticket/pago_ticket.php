<section class="content">
    <div class="container-fluid">
        <input type="hidden" id="valor_tasa_actual" value="40.50"> 
        <input type="hidden" id="id_usuario_sesion" value="1">

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            <center style="color: white;"> Control de Tickets y Procesamiento de Pagos </center>
                        </h2>
                        <button type="button" class="btn btn-success btn-circle waves-effect waves-circle waves-float" data-toggle="modal" data-target="#modal" id="abrirModal" title="Generar Ticket de Entrada">
                            <i class="material-icons">add</i>
                        </button>

                        <button type="hidden" style="display: none;" data-toggle="modal" data-target="#modalCobrar" id="abrirModalCobrar"> </button>
                        <button type="hidden" style="display: none;" data-toggle="modal" data-target="#modalEditarPago" id="abrirModalEditarPago"> </button>
                    </div>
                    
                    <div class="body table-responsive">
                        <table class="table" id="tabla">
                            <thead>
                                <tr>
                                    <th> # </th>
                                    <th>Vehículo (Placa)</th>
                                    <th>Zona</th>
                                    <th>Fecha y Hora de Entrada</th>
                                    <th>Estatus</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'app/views/page/pago_ticket/modal.php'; ?>

<script src="resources/library/plugins/jquery/jquery.min.js"></script>
<script src="public/js/ticket.js"></script>
<script src="public/js/pago.js"></script>