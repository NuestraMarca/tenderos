<div id="modal-fade" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title"><strong id="modal-shopkeeper-name">Mr. Brennon Stamm MD</strong>
                    @if(Auth::user()->isAdmin()) 
                        <a id="modal-shopkeeper-id" href="" title="Editar" class="btn btn-primary">
                            <i class="fa fa-pencil"></i>
                        </a> 
                        <a id="modal-shopkeeper-shopping" href="" title="Editar" class="btn btn-info">
                            <i class="fa fa-paper-plane"></i>
                        </a> 
                    @endif
                </h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6">
                        <p class="h4"><i class="fa fa-at text-primary"></i> <span id="modal-shopkeeper-email">Kailey.Gorczany@Haag.com</span></p>
                        <p class="h4"><i class="gi gi-iphone_shake text-danger"></i> <span id="modal-shopkeeper-tel">3142308171</span></p>
                        <p class="h4"><i class="gi gi-home text-primary"></i> 
                            <span id="modal-shopkeeper-address">Carrera 38 # 23 - 68 San Benito</span>
                            - Comuna <span id="modal-shopkeeper-commune"> 1 </span>
                        </p>
                        <p class="h4"><i class="fa fa-map-marker text-danger"></i> <span id="modal-shopkeeper-municipality">Villavicencio</span></p>

                        <div class="block">
                            <div class="block-title">
                                <h2><i class="fa fa-map-marker"></i> Ubicación</h2>
                            </div>
                            <div class="block-content-full">
                                <div id="gmap-markers" class="gmap" style="height: 260px;"></div>
                            </div>
                        </div>                                      
                    </div>
                    <div class="col-sm-6">
                        <p class="h3 sub-header">Interes de Compras</p>
                        <table class="table table-striped table-borderless table-hover table-vcenter">
                            <tbody id="modal-shopkeeper-shoppingInterests">
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-effect-ripple btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>