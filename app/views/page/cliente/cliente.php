<section class="content">
    <div class="container-fluid">
        <!-- Default Example -->
        <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                <center style="color: white;"> Lista de clientes </center>
                            </h2>
                            <button type="button" class="btn btn-success btn-circle waves-effect waves-circle waves-float" data-toggle="modal" data-target="#modal" id="abrirModal">
                                <i class="material-icons">add</i>
                            </button>

                            <!-- Se usar para abrir el modal editar, no abre el modal con jQuery x.x -->
                            <button type="hidden" style="display: none;" data-toggle="modal" data-target="#modalEditar" id="abrirModalEditar"> </button>
                        </div>
                        <div class="body table-responsive">

                        <!-- BUSCADOR EN TIEMPO REAL PARA LA TABLA (Añadido aquí) -->
                        <div class="row clearfix" style="margin-bottom: 15px; margin-top: 5px;">
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="input-group" style="margin-bottom: 0px;">
                                    <span class="input-group-addon">
                                        <i class="material-icons">search</i>
                                    </span>
                                    <div class="form-line">
                                        <input type="text" id="buscarEnTablaClientes" class="form-control" placeholder="Buscar por cédula">
                                    </div>
                                </div>
                            </div>
                        </div>
                            <table class="table" id="tabla">
                                <thead>
                                    <tr>
                                        <th> # </th>
                                        <th>cedula</th>
                                        <th>nombre</th>
                                        <th>apellido</th>
                                        <th>telefono</th>
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

<?php include 'app/views/page/cliente/modal.php'; ?>
<script src="resources/library/plugins/jquery/jquery.min.js"></script>
<script src="public/js/cliente.js"></script>