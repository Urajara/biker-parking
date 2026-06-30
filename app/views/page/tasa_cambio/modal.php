<div class="modal fade" id="modal" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header modal-col-grey">
                <h4 class="modal-title" id="defaultModalLabel">Agregar Tasa de Cambio</h4>
            </div>
            <form id="formulario">
                <div class="modal-body">
                    <div class="row"> <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">monetization_on</i>
                                </span>
                                <div class="form-line">
                                    <input type="text" class="form-control" placeholder="Valor Bs" id="valor_bs" name="valor_bs">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">today</i>
                                </span>
                                <div class="form-line">
                                    <input type="text" class="form-control date" placeholder="Fecha Tasa Cambio" id="fecha_tasa" name="fecha_tasa">
                                </div>
                            </div>
                        </div>

                    </div>
                </div> 
                <div class="modal-footer">
                    <button type="button" class="btn btn-success waves-effect" id="guardar">Guardar Tasa</button>
                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal" id="cerrar">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header modal-col-grey">
                <h4 class="modal-title" id="defaultModalLabel">Editar Tasa Cambio</h4>
            </div>
            <form id="formularioEditar">
                <div class="modal-body">
                    <div class="row">
                        
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">monetization_on</i>
                                </span>
                                <div class="form-line">
                                    <input type="hidden" id="idTasa_cambio" name="idTasa_cambio">
                                    <input type="text" class="form-control" placeholder="Valor Bs" id="valor_bsEditar" name="valor_bsEditar">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">today</i>
                                </span>
                                <div class="form-line">
                                    <input type="text" class="form-control date" placeholder="Fecha Tasa Cambio" id="fecha_tasaEditar" name="fecha_tasaEditar">
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success waves-effect" id="editar">Modificar Tasa</button>
                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal" id="cerrarEditar">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>