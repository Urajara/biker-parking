<div class="modal fade" id="modal" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header modal-col-grey">
                <h4 class="modal-title" id="defaultModalLabel"> Generar Ticket de Entrada </h4>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <form id="formularioTicket">
                        
                        <div class="col-md-12" style="margin-bottom: 20px;">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">motorcycle</i>
                                </span>
                                <div class="form-line">
                                    <select class="form-control" id="id_vehiculo">
                                        <option value="">-- Seleccione la Moto (Placa) --</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12" style="margin-bottom: 20px;">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">layers</i>
                                </span>
                                <div class="form-line">
                                    <select class="form-control" id="id_zona">
                                        <option value="">-- Seleccione la Zona de Estacionamiento --</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div> 
            <div class="modal-footer">
                <button type="button" class="btn btn-success waves-effect" id="guardarTicket" onclick="crearTicket();"> Registrar Entrada </button>
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal" id="cerrarTicket"> Cerrar </button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modalCobrar" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header modal-col-grey">
                <h4 class="modal-title" id="defaultModalLabel"> Procesar Cobro de Ticket </h4>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <form id="formularioCobro">
                        
                        <input type="hidden" id="id_ticket">
                        <input type="hidden" id="id_tasa" value="1">

                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="material-icons">confirmation_number</i></span>
                                <div class="form-line">
                                    <input type="text" class="form-control" placeholder="Ticket Nro" id="txt_id_ticket_ver" readonly style="background: #eee; font-weight: bold;">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="material-icons">motorcycle</i></span>
                                <div class="form-line">
                                    <input type="text" class="form-control" placeholder="Moto / Placa" id="txt_placa_cobro" readonly style="background: #eee; font-weight: bold;">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12" style="margin-bottom: 20px;">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="material-icons">access_time</i></span>
                                <div class="form-line">
                                    <input type="text" class="form-control" placeholder="Fecha y Hora de Entrada" id="txt_entrada_cobro" readonly style="background: #eee;">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="material-icons">attach_money</i></span>
                                <div class="form-line">
                                    <input type="text" class="form-control" placeholder="Monto ($)" id="monto_dolares" readonly style="font-weight: bold; color: #4CAF50;">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="material-icons">monetization_on</i></span>
                                <div class="form-line">
                                    <input type="text" class="form-control" placeholder="Monto Final (Bs)" id="monto_final_pagado" readonly style="font-weight: bold; color: #2196F3;">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6" style="margin-top: 15px;">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="material-icons">payment</i></span>
                                <div class="form-line">
                                    <select class="form-control" id="id_forma_pago">
                                        <option value="">-- Forma de Pago --</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6" style="margin-top: 15px;">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="material-icons">account_balance</i></span>
                                <div class="form-line">
                                    <select class="form-control" id="id_banco">
                                        <option value="">-- Banco Destino (Si Aplica) --</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="material-icons">receipt</i></span>
                                <div class="form-line">
                                    <input type="text" class="form-control" placeholder="Número de Referencia" id="referencia">
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success waves-effect" id="guardarPago" onclick="crear();"> Registrar Pago y Salida </button>
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal" id="cerrarCobro"> Cerrar </button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modalEditarPago" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header modal-col-grey">
                <h4 class="modal-title" id="defaultModalLabel"> Editar Registro de Pago </h4>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <form id="formularioEditarPago">
                        
                        <input type="hidden" id="idPagoEditar">
                        <input type="hidden" id="id_ticketEditar">
                        <input type="hidden" id="id_tasaEditar">

                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="material-icons">attach_money</i></span>
                                <div class="form-line">
                                    <input type="text" class="form-control" placeholder="Monto ($)" id="monto_dolaresEditar">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="material-icons">monetization_on</i></span>
                                <div class="form-line">
                                    <input type="text" class="form-control" placeholder="Monto Final (Bs)" id="monto_final_pagadoEditar">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="material-icons">payment</i></span>
                                <div class="form-line">
                                    <select class="form-control" id="id_forma_pagoEditar">
                                        <option value="">-- Forma de Pago --</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="material-icons">account_balance</i></span>
                                <div class="form-line">
                                    <select class="form-control" id="id_bancoEditar">
                                        <option value="">-- No aplica --</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="material-icons">receipt</i></span>
                                <div class="form-line">
                                    <input type="text" class="form-control" placeholder="Número de Referencia" id="referenciaEditar">
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success waves-effect" id="editarPago" onclick="editar();"> Modificar Registro </button>
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal" id="cerrarEditarPago"> Cerrar </button>
            </div>
        </div>
    </div>
</div>