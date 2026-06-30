<div class="modal fade" id="modalUsuario" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog modal-lg" role="document"> 
        <div class="modal-content">
            <div class="modal-header" style="background-color: #d32f2f; color: white;">
                <h4 class="modal-title" id="defaultModalLabel" style="color: white;"> Agregar Nuevo Usuario / Operador </h4>
            </div>
            <div class="modal-body">
                <div class="row clearfix">
                    <form id="formularioUsuario">
                        
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="material-icons">card_membership</i></span>
                                <div class="form-line">
                                    <input type="text" class="form-control" placeholder="Cédula" id="cedulaUsuario">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="material-icons">vpn_key</i></span>
                                <div class="form-line">
                                    <input type="password" class="form-control" placeholder="Contraseña de Acceso" id="passwordUsuario">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="material-icons">person</i></span>
                                <div class="form-line">
                                    <input type="text" class="form-control" placeholder="Nombre" id="nombreUsuario">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="material-icons">person</i></span>
                                <div class="form-line">
                                    <input type="text" class="form-control" placeholder="Apellido" id="apellidoUsuario">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="material-icons">assignment_ind</i></span>
                                <div class="form-line">
                                    <select class="form-control show-tick" id="idRolUsuario">
                                        <option value="">-- Seleccione el Rol del Trabajador --</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="material-icons">toggle_on</i></span>
                                <div class="form-line">
                                    <select class="form-control show-tick" id="estatusUsuario">
                                        </select>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div> 
            <div class="modal-footer">
                <button type="button" class="btn btn-success waves-effect" id="guardarUsuario"> Guardar Usuario</button>
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal" id="cerrarUsuario"> Cerrar </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalUsuarioEditar" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #d32f2f; color: white;">
                <h4 class="modal-title" id="defaultModalLabel" style="color: white;"> Editar Datos del Usuario </h4>
            </div>
            <div class="modal-body">
                <div class="row clearfix">
                    <form id="formularioUsuarioEditar">
                        
                        <input type="hidden" id="idUsuarioEditar">

                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="material-icons">card_membership</i></span>
                                <div class="form-line">
                                    <input type="text" class="form-control" placeholder="Cédula" id="cedulaUsuarioEditar">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="material-icons">vpn_key</i></span>
                                <div class="form-line">
                                    <input type="password" class="form-control" placeholder="Nueva Clave (Dejar en blanco si no cambia)" id="passwordUsuarioEditar">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="material-icons">person</i></span>
                                <div class="form-line">
                                    <input type="text" class="form-control" placeholder="Nombre" id="nombreUsuarioEditar">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="material-icons">person</i></span>
                                <div class="form-line">
                                    <input type="text" class="form-control" placeholder="Apellido" id="apellidoUsuarioEditar">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="material-icons">assignment_ind</i></span>
                                <div class="form-line">
                                    <select class="form-control" id="idRolUsuarioEditar">
                                        <option value="">-- Seleccione el Rol --</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="material-icons">toggle_on</i></span>
                                <div class="form-line">
                                    <select class="form-control" id="estatusUsuarioEditar">
                                        </select>
                                </div>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success waves-effect" id="editarUsuario"> Guardar Cambios </button>
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal" id="cerrarUsuarioEditar"> Cerrar </button>
            </div>
        </div>
    </div>
</div>