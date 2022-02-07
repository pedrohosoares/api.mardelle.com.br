@extends('voyager::master')

@section('page_title', ' ' . __('Dashboard'))
@section('css')
    <style>
        .panel-actions .voyager-trash {
            cursor: pointer;
        }

        .panel-actions .voyager-trash:hover {
            color: #e94542;
        }

        .settings .panel-actions {
            right: 0px;
        }

        .panel hr {
            margin-bottom: 10px;
        }

        .panel {
            padding-bottom: 15px;
        }

        .sort-icons {
            font-size: 21px;
            color: #ccc;
            position: relative;
            cursor: pointer;
        }

        .sort-icons:hover {
            color: #37474F;
        }

        .voyager-sort-desc {
            margin-right: 10px;
        }

        .voyager-sort-asc {
            top: 10px;
        }

        .page-title {
            margin-bottom: 0;
        }

        .panel-title code {
            border-radius: 30px;
            padding: 5px 10px;
            font-size: 11px;
            border: 0;
            position: relative;
            top: -2px;
        }

        .modal-open .settings .select2-container {
            z-index: 9 !important;
            width: 100% !important;
        }

        .new-setting {
            text-align: center;
            width: 100%;
            margin-top: 20px;
        }

        .new-setting .panel-title {
            margin: 0 auto;
            display: inline-block;
            color: #999fac;
            font-weight: lighter;
            font-size: 13px;
            background: #fff;
            width: auto;
            height: auto;
            position: relative;
            padding-right: 15px;
        }

        .settings .panel-title {
            padding-left: 0px;
            padding-right: 0px;
        }

        .new-setting hr {
            margin-bottom: 0;
            position: absolute;
            top: 7px;
            width: 96%;
            margin-left: 2%;
        }

        .new-setting .panel-title i {
            position: relative;
            top: 2px;
        }

        .new-settings-options {
            display: none;
            padding-bottom: 10px;
        }

        .new-settings-options label {
            margin-top: 13px;
        }

        .new-settings-options .alert {
            margin-bottom: 0;
        }

        #toggle_options {
            clear: both;
            float: right;
            font-size: 12px;
            position: relative;
            margin-top: 15px;
            margin-right: 5px;
            margin-bottom: 10px;
            cursor: pointer;
            z-index: 9;
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            -khtml-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        .new-setting-btn {
            margin-right: 15px;
            position: relative;
            margin-bottom: 0;
            top: 5px;
        }

        .new-setting-btn i {
            position: relative;
            top: 2px;
        }

        textarea {
            min-height: 120px;
        }

        textarea.hidden {
            display: none;
        }

        .voyager .settings .nav-tabs {
            background: none;
            border-bottom: 0px;
        }

        .voyager .settings .nav-tabs .active a {
            border: 0px;
        }

        .select2 {
            width: 100% !important;
            border: 1px solid #f1f1f1;
            border-radius: 3px;
        }

        .voyager .settings input[type=file] {
            width: 100%;
        }

        .settings .select2 {
            margin-left: 10px;
        }

        .settings .select2-selection {
            height: 32px;
            padding: 2px;
        }

        .voyager .settings .nav-tabs>li {
            margin-bottom: -1px !important;
        }

        .voyager .settings .nav-tabs a {
            text-align: center;
            background: #f8f8f8;
            border: 1px solid #f1f1f1;
            position: relative;
            top: -1px;
            border-bottom-left-radius: 0px;
            border-bottom-right-radius: 0px;
        }

        .voyager .settings .nav-tabs a i {
            display: block;
            font-size: 22px;
        }

        .tab-content {
            background: #ffffff;
            border: 1px solid transparent;
        }

        .tab-content>div {
            padding: 10px;
        }

        .settings .no-padding-left-right {
            padding-left: 0px;
            padding-right: 0px;
        }

        .nav-tabs>li.active>a,
        .nav-tabs>li.active>a:focus,
        .nav-tabs>li.active>a:hover {
            background: #fff !important;
            color: #62a8ea !important;
            border-bottom: 1px solid #fff !important;
            top: -1px !important;
        }

        .nav-tabs>li a {
            transition: all 0.3s ease;
        }


        .nav-tabs>li.active>a:focus {
            top: 0px !important;
        }

        .voyager .settings .nav-tabs>li>a:hover {
            background-color: #fff !important;
        }




        .sk-chase {
            width: 40px;
            height: 40px;
            position: relative;
            animation: sk-chase 2.5s infinite linear both;
        }

        .sk-chase-dot {
            width: 100%;
            height: 100%;
            position: absolute;
            left: 0;
            top: 0;
            animation: sk-chase-dot 2.0s infinite ease-in-out both;
        }

        .sk-chase-dot:before {
            content: '';
            display: block;
            width: 25%;
            height: 25%;
            background-color: #877474;
            border-radius: 100%;
            animation: sk-chase-dot-before 2.0s infinite ease-in-out both;
        }

        .sk-chase-dot:nth-child(1) {
            animation-delay: -1.1s;
        }

        .sk-chase-dot:nth-child(2) {
            animation-delay: -1.0s;
        }

        .sk-chase-dot:nth-child(3) {
            animation-delay: -0.9s;
        }

        .sk-chase-dot:nth-child(4) {
            animation-delay: -0.8s;
        }

        .sk-chase-dot:nth-child(5) {
            animation-delay: -0.7s;
        }

        .sk-chase-dot:nth-child(6) {
            animation-delay: -0.6s;
        }

        .sk-chase-dot:nth-child(1):before {
            animation-delay: -1.1s;
        }

        .sk-chase-dot:nth-child(2):before {
            animation-delay: -1.0s;
        }

        .sk-chase-dot:nth-child(3):before {
            animation-delay: -0.9s;
        }

        .sk-chase-dot:nth-child(4):before {
            animation-delay: -0.8s;
        }

        .sk-chase-dot:nth-child(5):before {
            animation-delay: -0.7s;
        }

        .sk-chase-dot:nth-child(6):before {
            animation-delay: -0.6s;
        }

        @keyframes sk-chase {
            100% {
                transform: rotate(360deg);
            }
        }

        @keyframes sk-chase-dot {

            80%,
            100% {
                transform: rotate(360deg);
            }
        }

        @keyframes sk-chase-dot-before {
            50% {
                transform: scale(0.4);
            }

            100%,
            0% {
                transform: scale(1.0);
            }
        }

    </style>
@stop

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-settings">
        </i> {{ __('Dashboard') }}
    </h1>
@stop

@section('content')
    <div class="page-content settings container-fluid">

        <div style="clear:both">
        </div>

    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-bordered">
                <div class="panel-body">
                    <div class="table-responsive">
                        <div id="dataTable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                            <div class="row">
                                <div class="col-md-12">
                                    Veja as vendas de hoje
                                </div>
                            </div>
                            <div class="row">
                                <div class="text-center col-md-6">
                                    <h2>Total de vendas</h2>
                                    <br />
                                    <span class='h3' id="totalQuantitySales">3</span>
                                </div>
                                <div class="text-center col-md-6">
                                    <h2>Valor Total</h2>
                                    <br />
                                    <span class='h3' id="totalAmount">R$200,00</span>
                                </div>
                            </div>
                            <div class="row" style="height: 100px;"></div>
                            <div class="row">
                                <div class="text-left col-md-12">
                                    <div class="sk-chase col-md-1">
                                        <div class="sk-chase-dot"></div>
                                        <div class="sk-chase-dot"></div>
                                        <div class="sk-chase-dot"></div>
                                        <div class="sk-chase-dot"></div>
                                        <div class="sk-chase-dot"></div>
                                        <div class="sk-chase-dot"></div>
                                    </div>
                                    <h3 class="col-md-3">Últimas vendas</h3>
                                </div>
                            </div>
                            <div class="row">
                                <table class="table table-responsive table-hover">
                                    <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Cep</th>
                                            <th>Valor</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>João Lucas</td>
                                            <td>31002-201</td>
                                            <td>R$100</td>
                                        </tr>
                                        <tr>
                                            <td>João Lucas</td>
                                            <td>31002-201</td>
                                            <td>R$100</td>
                                        </tr>
                                        <tr>
                                            <td>João Lucas</td>
                                            <td>31002-201</td>
                                            <td>R$100</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop


@section('javascript')
    <script>
        jQuery(document).ready(function($) {

            const soares_leads = {
                user_id: "{{ Auth::User()->id }}",
                email: "{{ Auth::User()->email }}",
                totalQuantitySales: $('#totalQuantitySales'),
                totalAmount: $('#totalAmount'),
                downloadExcel() {
                    this.download_excel.click(() => {
                        const url = '/admin/download_cadastro_incompleto?localizacao=' + this
                            .localizacao_feira
                            .val() + '&expositor=' + this.expositor_feira + '&leads=' + this.leads_feira
                            .val() + "&cliente=" + this.cliente_feira.val() + '&orderBy=' + this
                            .selectOrderBy.val() +
                            '&orderAscDesc=' + this.orderAscDesc.val();
                        window.open(url, "_blank");
                    });
                },
                putSales(e) {
                    this.total_leads.text(e.meta.total);
                    this.currentPage.text(e.meta.current_page);
                    this.lastPage.text(e.meta.last_page);
                    if (e.data != undefined) {

                        for (i in e.data) {
                            v = e.data[i];
                            v.created_at = (v.created_at.split(' ')[0]).split('-').reverse().join('/') + ' ' + v
                                .created_at.split(' ')[1];
                            if (v.length != 0) {
                                let linkCard = `
                                <a href="/admin/validar-entrada/${v.email}/${v.city_event_id}" title="Editar" class="validar-entrada btn btn-sm btn-primary pull-right edit">
                                    <i href="/admin/validar-entrada/${v.email}/${v.city_event_id}" class="voyager-edit"></i>
                                    <span href="/admin/validar-entrada/${v.email}/${v.city_event_id}" class="hidden-xs hidden-sm">Validar Entrada</span>
                                </a>
                                `;
                                if (v.confirm != null) {
                                    linkCard = `
                                    <a href="#" disabled title="Editar" class="validar-entrada btn btn-sm btn-primary pull-right edit">
                                        <i class="voyager-edit"></i>
                                        <span class="hidden-xs hidden-sm">Validado</span>
                                    </a>
                                    `;
                                }
                                const brand_name = (v.brand != null) ? v.brand.name : "";
                                const html = `
                                    <tr>
                                        <td>${v.name}</td>
                                        <td>${v.email}</td>
                                        <td>${v.telefone}</td>
                                        <td>${v.created_at}</td>
                                    </tr>
                                `;
                                this.tbody.append(html);
                                this.buscar.text('Buscar');
                                this.buscar.removeAttr('disabled');
                            }
                        }
                    } else {
                        this.tbody.html('');
                        this.buscar.text('Buscar');
                        this.buscar.removeAttr('disabled');
                    }
                },
                ajaxGetLastSales() {
                    $.ajax({
                        url: this.url,
                        type: 'GET',
                        headers: {
                            Authorization: 'Bearer ' + this.token
                        },
                        success: (e) => {
                            this.putSales(e);
                        },
                        complete: (e) => {
                            this.buscar.text('Buscar');
                            this.buscar.removeAttr('disabled');
                        }
                    });
                },
                init() {
                    this.url = '/admin/get-cadastros-incompletos?localizacao=' + this.localizacao_feira.val() +
                        '&expositor=' + this.expositor_feira + '&leads=' + this.leads_feira.val() +
                        "&cliente=" + this.cliente_feira.val() + '&orderBy=' + this.selectOrderBy.val() +
                        '&orderAscDesc=' + this.orderAscDesc.val();
                    this.ajaxGetLastSales();
                    this.downloadExcel();
                }

            };
            //soares_leads.init();

        });
    </script>
@stop
