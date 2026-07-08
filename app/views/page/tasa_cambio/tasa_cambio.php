<section class="content">
    <div class="container-fluid">
        <!-- Default Example -->
        <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                <center style="color: white;"> Tasas de Cambio</center>
                            </h2>
                            <button type="button" class="btn btn-success btn-circle waves-effect waves-circle waves-float" data-toggle="modal" data-target="#modal" id="abrirModal">
                                <i class="material-icons">add</i>
                            </button>

                            <!-- Se usar para abrir el modal editar, no abre el modal con jQuery x.x -->
                            <button type="hidden" style="display: none;" data-toggle="modal" data-target="#modalEditar" id="abrirModalEditar"> </button>
                        </div>
                        <div class="body table-responsive">

                        <div class="row clearfix" style="margin-bottom: 15px; margin-top: 5px;">
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="input-group" style="margin-bottom: 0px; display: flex; align-items: center;">
                                    <span class="input-group-addon" style="padding-bottom: 0px; padding-top: 10px; margin-right: 10px;">
                                        <i class="material-icons">search</i>
                                    </span>
                                    <div class="form-line" style="width: 100%;">
                                        <input type="text" id="buscarEnTablaTasas" class="form-control" placeholder="Buscar fecha (AAAA-MM-DD)..." style="padding-left: 5px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                                                    <table class="table" id="tabla">
                                <thead>
                                    <tr>
                                        <th> # </th>
                                        <th>Valor Bs</th>
                                        <th>Fecha Tasa</th>
                                        <th>opciones</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <!-- #END# Default Example -->
    </div>
</section>

<?php include 'app/views/page/tasa_cambio/modal.php'; ?>
<script src="resources/library/plugins/jquery/jquery.min.js"></script>
<script src="public/js/tasa_cambio.js"></script>