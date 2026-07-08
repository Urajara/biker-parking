<div class="modal fade" id="modal" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header modal-col-grey">
                <h4 class="modal-title" id="defaultModalLabel"> Agregar Moto </h4>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <form id="formulario">
                    
                        <!-- BUSCADOR DINÁMICO PROFESIONAL DE DUEÑO -->
                        <div class="col-md-12" style="margin-bottom: 20px; position: relative;">
                            <div class="input-group" style="margin-bottom: 0px;">
                                <span class="input-group-addon">
                                    <i class="material-icons">assignment_ind</i>
                                </span>
                                <div class="form-line">
                                    <!-- Input visible para escribir la cédula o nombre -->
                                    <input type="text" class="form-control" id="buscarCedulaDueno" placeholder="🔍 Buscar dueño por cédula..." autocomplete="off">
                                </div>
                            </div>
                            
                            <!-- Contenedor flotante para los resultados encontrados -->
                            <div id="sugerenciasClientes" class="list-group" 
                                style="position: absolute; top: 100%; left: 50px; right: 15px; z-index: 1050; display: none; max-height: 200px; overflow-y: auto; box-shadow: 0 4px 10px rgba(0,0,0,0.2); border-radius: 4px;">
                            </div>

                            <!-- Input oculto que almacena el ID del cliente seleccionado para el controlador PHP -->
                            <input type="hidden" id="id_cliente" name="id_cliente">
                        </div>

                        <!-- CAMPOS DEL VEHÍCULO -->
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">person</i>
                                </span>
                                <div class="form-line">
                                    <input type="text" class="form-control date" placeholder="Placa" id="placa">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">person</i>
                                </span>
                                <div class="form-line">
                                    <input type="text" class="form-control date" placeholder="Marca" id="marca">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">person</i>
                                </span>
                                <div class="form-line">
                                    <input type="text" class="form-control date" placeholder="Modelo" id="modelo">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">person</i>
                                </span>
                                <div class="form-line">
                                    <input type="text" class="form-control date" placeholder="Color" id="color">
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div> 
            <div class="modal-footer">
                <button type="button" class="btn btn-success waves-effect" id="guardar"> Guardar Moto</button>
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal" id="cerrar"> Cerrar </button>
            </div>
        </div>
    </div>
</div>

<!-- ================================================================================================= -->
<!--                                       MODAL: EDITAR MOTO                                          -->
<!-- ================================================================================================= -->
<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header modal-col-grey">
                <h4 class="modal-title" id="defaultModalLabel"> Editar Moto </h4>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <form id="formularioEditar">
                        
                        <!-- Mantenemos el select clásico en la edición para que cargue directamente el dueño actual -->
                        <div class="col-md-12" style="margin-bottom: 20px;">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">assignment_ind</i>
                                </span>
                                <div class="form-line">
                                    <select class="form-control" id="id_clienteEditar">
                                        <option value="">-- Cambiar Dueño (Cédula) --</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">person</i>
                                </span>
                                <div class="form-line">
                                    <input type="hidden" id="idMoto">
                                    <input type="text" class="form-control date" placeholder="Placa" id="placaEditar">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">person</i>
                                </span>
                                <div class="form-line">
                                    <input type="text" class="form-control date" placeholder="Marca" id="marcaEditar">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">person</i>
                                </span>
                                <div class="form-line">
                                    <input type="text" class="form-control date" placeholder="Modelo" id="modeloEditar">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">vpn_key</i>
                                </span>
                                <div class="form-line">
                                    <input type="text" class="form-control date" placeholder="Color" id="colorEditar">
                                </div>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success waves-effect" id="editar"> Editar Moto </button>
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal" id="cerrarEditar"> Cerrar </button>
            </div>
        </div>
    </div>
</div>