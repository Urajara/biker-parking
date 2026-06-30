<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header" style="background-color: #d32f2f; color: white; padding: 20px; border-top-left-radius: 4px; border-top-right-radius: 4px; position: relative;">
                        <h2>
                            <center style="color: white; font-weight: bold;">Control de Usuarios y Operadores</center>
                        </h2>
                        
                        <button type="button" class="btn btn-success btn-circle waves-effect waves-circle waves-float" data-toggle="modal" data-target="#modalUsuario" id="abrirModalUsuario" title="Registrar Trabajador" style="position: absolute; bottom: -20px; left: 20px; z-index: 9;">
                            <i class="material-icons">add</i>
                        </button>

                        <button type="button" style="display: none;" data-toggle="modal" data-target="#modalUsuarioEditar" id="abrirModalUsuarioEditar"></button>
                    </div>
                    
                    <div class="body table-responsive" style="padding-top: 35px;">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th> # </th>
                                    <th>Cédula</th>
                                    <th>Nombre Completo</th>
                                    <th>Rol / Cargo</th>
                                    <th>Estatus</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody id="tablaUsuarios">
                                </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'app/views/page/usuarios/modal.php'; ?>

<script src="resources/library/plugins/jquery/jquery.min.js"></script>
<script src="public/js/usuarios.js"></script>