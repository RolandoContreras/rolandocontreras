<div class="pcoded-main-container">
    <div class="pcoded-wrapper">
        <div class="pcoded-content">
            <div class="pcoded-inner-content">
                <div class="page-header">
                    <div class="page-block">
                        <div class="row align-items-center">
                            <div class="col-md-12">
                                <div class="page-header-title">
                                    <h5 class="m-b-10">Tablero</h5>
                                </div>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a>Panel General</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="main-body">
                    <div class="page-wrapper">
                        <div class="row">
                            <div class="col-md-6 col-xl-4">
                                <div class="card Active-visitor">
                                    <div class="card-block text-center">
                                        <h5 class="mb-3">Clientes</h5>
                                        <i class="fas fa-user-friends f-30 text-c-green"></i>
                                        <a href="<?php echo site_url() . 'dashboard/clientes'; ?>">
                                            <h2 class="f-w-300 mt-3"><?php echo $obj_total->total_customer; ?></h2>
                                        </a>
                                        <div class="progress m-t-30" style="height: 7px;">
                                            <div class="progress-bar progress-c-theme" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-4">
                                <div class="card Active-visitor">
                                    <div class="card-block text-center">
                                        <h5 class="mb-3">Comentarios</h5>
                                        <i class="fas fa-envelope-open-text f-30 text-c-green"></i>
                                        <a href="<?php echo site_url() . 'dashboard/comentarios'; ?>">
                                            <h2 class="f-w-300 mt-3"><?php echo $obj_total->total_contact; ?></h2>
                                        </a>
                                        <a href="<?php echo site_url() . 'dashboard/comentarios'; ?>">
                                            <span class="text-muted"><?php echo $obj_pending->pending_comments;?> Pendientes por Responder</span>
                                        </a>
                                        <div class="progress m-t-30" style="height: 7px;">
                                            <div class="progress-bar progress-c-theme" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-4"></div>
                            <div class="col-md-6 col-xl-4">
                                <div class="card">
                                    <div class="card-block">
                                        <h6 class="mb-4">Nuevos Clientes Semana Actual</h6>
                                        <span class="d-block pt-2"><?php echo formato_fecha_dia_mes($lunes_semana_actual) . " - " . formato_fecha_dia_mes($domingo_semana_actual); ?></span>
                                        <div class="row d-flex align-items-center">
                                            <div class="col-9">
                                                <h3 class="f-w-300 d-flex align-items-center m-b-0">
                                                    <i class="fa fa-wallet text-c-green f-30 m-r-10"></i>
                                                    &dollar;<?php echo!empty($obj_invoices->total_semana) ? $obj_invoices->total_semana : "0.00"; ?>
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="progress m-t-30" style="height: 7px;">
                                            <div class="progress-bar progress-c-theme" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-4">
                                <div class="card">
                                    <div class="card-block">
                                        <h6 class="mb-4">Clientes Mes Actual</h6>
                                        <span class="d-block pt-2">Año <?php echo $year; ?></span>
                                        <div class="row d-flex align-items-center">
                                            <div class="col-9">
                                                <h3 class="f-w-300 d-flex align-items-center m-b-0">
                                                    <i class="fa fa-wallet text-c-green f-30 m-r-10"></i>
                                                    &dollar;<?php echo!empty($obj_invoices->total_year) ? $obj_invoices->total_year : "0.00"; ?>
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="progress m-t-30" style="height: 7px;">
                                            <div class="progress-bar progress-c-theme" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-4">
                                <div class="card">
                                    <div class="card-block">
                                        <h6 class="mb-4">Reporte / <?php echo $mes_actual; ?></h6>
                                        <span class="d-block pt-2">Ventas e Ingresos</span>
                                        <div class="row d-flex align-items-center">
                                            <div class="col-9">
                                                <h3 class="f-w-300 d-flex align-items-center m-b-0">
                                                    <i class="fa fa-wallet text-c-green f-30 m-r-10"></i>
                                                    &dollar;<?php echo!empty($obj_invoices->total_mes) ? $obj_invoices->total_mes : "0.00"; ?>
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="progress m-t-30" style="height: 7px;">
                                            <div class="progress-bar progress-c-theme" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>