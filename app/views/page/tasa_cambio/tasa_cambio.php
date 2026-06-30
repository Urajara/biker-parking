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