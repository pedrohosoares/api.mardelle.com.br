@extends('voyager::master')

@section('page_title', ' ' . __('Vendas'))
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

    </style>
@stop

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-world">
        </i> {{ __('Mapa de Vendas') }}
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
                                <div>
                                    <label>
                                        <br />
                                        <button
                                            data-date="{{ date('Y-m-d', strtotime('+1 month', strtotime(simpleDateRight()))) }}"
                                            class="btn btn-default btnDate">1 mês</button>
                                    </label>
                                    <label>
                                        <br />
                                        <button
                                            data-date="{{ date('Y-m-d', strtotime('+15 days', strtotime(simpleDateRight()))) }}"
                                            class="btn btn-default btnDate">15 dias</button>
                                    </label>
                                    <label>
                                        <br />
                                        <button
                                            data-date="{{ date('Y-m-d', strtotime('+1 week', strtotime(simpleDateRight()))) }}"
                                            class="btn btn-default btnDate">1 semana</button>
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <form method="GET" id="formSearch">
                                    <div>
                                        <div class="dataTables_length" id="dataTable_length">
                                            <label>
                                                Franqueado
                                                <br />
                                                <select name="user" class="form-control input-sm" id="selectUser">
                                                    <option value="">Todos</option>
                                                </select>
                                            </label>
                                            <label>
                                                Data de início
                                                <br />
                                                <input value="{{ $date_start }}" type="date" class="form-control input-sm"
                                                    name="date_start" id="date_start" />
                                            </label>
                                            <label>
                                                Data final
                                                <br />
                                                <input value="{{ $date_end }}" type="date" class="form-control input-sm"
                                                    name="date_end" id="date_end" />
                                            </label>
                                            <label>
                                                Meio de pagamento
                                                <br />
                                                <select class="form-control input-sm" name="payments_form"
                                                    id="payments_form">
                                                    <option value="">Todos</option>
                                                </select>
                                            </label>
                                            <label>
                                                <button class="btn btn-success" id="buscar">Buscar</button>
                                            </label>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <br />
                            <div class="row">
                                <p>Regiões com mais vendas</p>
                            </div>
                            <div class="row">
                                <div class="card text-center col-md-3" data-location="1">
                                    <p>Nenhum</p>
                                    <h3 style="padding-left:20px;">
                                        <span>0</span>
                                    </h3>
                                </div>
                                <div class="card text-center col-md-3" data-location="2">
                                    <p>Nenhum</p>
                                    <h3 style="padding-left:20px;">
                                        <span>0</span>
                                    </h3>
                                </div>
                                <div class="card text-center col-md-3" data-location="3">
                                    <p>Nenhum</p>
                                    <h3 style="padding-left:20px;">
                                        <span>0</span>
                                    </h3>
                                </div>
                                <div class="card text-center col-md-3" data-location="4">
                                    <p>Nenhum</p>
                                    <h3 style="padding-left:20px;">
                                        <span>0</span>
                                    </h3>
                                </div>
                            </div>
                            <br />
                            <div class="row" style="margin-top:40px;">
                                <div class="col-md-12">
                                    <div class="card text-center col-md-12">
                                        <br />
                                        <div id="status_pagamentos" style="height: 570px; max-width:100%; margin: 0px auto;">

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
@stop

<script type="text/javascript" src="{{ URL::to('/') }}/js/canvasjs.min.js"></script>
@section('javascript')
    <script>
        jQuery(document).ready(function($) {

            const soares_sales = {
                url: "",
                dataPoints: [],
                dataPointsKey: null,
                totalValue: $('span#totalValue'),
                divMonthsMoney: $('#divMonthsMoney'),
                getUser: "{{ $user }}",
                selectUser: $('#selectUser'),
                mediumValue: $('#mediumValue'),
                user_id: "{{ Auth::User()->id }}",
                email: "{{ Auth::User()->email }}",
                dateStart: "{{ $date_start }}",
                dateEnd: "{{ $date_end }}",
                inputDateEnd: $('input[name="date_end"]'),
                user: "{{ $user }}",
                payments_form: "{{ $payments_form }}",
                chartContainer: 'chartContainer',
                chartContainerMoney: 'chartContainerMoney',
                chartByStatusPizza: 'chartByStatusPizza',
                paymentsForm: $('#payments_form'),
                btnDate: $('.btnDate'),
                form: $('#formSearch'),
                meios_pagamentos: 'meios_pagamentos',
                status_pagamentos: 'status_pagamentos',
                total_clientes: $('#total_clientes'),
                total_vendas: $('#total_vendas'),
                months() {
                    let start = new Date(this.dateStart);
                    start.setDate(start.getDate() + 1);
                    let stop = new Date(this.dateEnd);
                    stop.setDate(stop.getDate() + 1);
                    let actual = new Date(this.dateStart);
                    let dates = [start];
                    while (actual < stop) {
                        actual.setMonth(actual.getMonth() + 1);
                        actual.setDate(1);
                        dates.push(actual.toLocaleString('pt-BR').split(' ')[0]);
                    }
                    dates[0] = start.toLocaleString('pt-BR').split(' ')[0]
                    dates[dates.length - 1] = stop.toLocaleString('pt-BR').split(' ')[0];
                    let newDate = [dates[0].split('/').reverse().join('-')];
                    newDate.push(dates[dates.length - 1].split('/').reverse().join('-'));
                    return newDate.join(',');
                },
                chartPorLocalizacao(object) {
                    let dataPoints = [];
                    object.forEach((v)=>{
                        dataPoints.push({
                            y: parseFloat(v.total),
                            name: v.location
                        });
                    });
                    const chart = new CanvasJS.Chart(this.status_pagamentos, {
                        exportEnabled: true,
                        animationEnabled: true,
                        title: {
                            text: "Mapa de Vendas"
                        },
                        legend: {
                            cursor: "pointer",
                            itemclick: ''
                        },
                        data: [{
                            type: "pie",
                            showInLegend: true,
                            toolTipContent: "{name}: <strong>R${y}</strong>",
                            indexLabel: "{name} - R${y}",
                            dataPoints: dataPoints
                        }]
                    });
                    chart.render();
                },
                verifySearchDateEnd() {
                    for (let index = 0; index < soares_sales.btnDate.length; index++) {
                        const element = soares_sales.btnDate[index];
                        element.classList.remove('btn-primary');
                        element.classList.add('btn-default');
                        if (this.dateEnd == element.dataset.date) {
                            element.classList.remove('btn-default');
                            element.classList.add('btn-primary');
                        }
                    }
                },
                clickInInterval() {
                    this.verifySearchDateEnd();
                    this.btnDate.click(function(e) {
                        e.preventDefault();
                        for (let index = 0; index < soares_sales.btnDate.length; index++) {
                            const element = soares_sales.btnDate[index];
                            element.classList.remove('btn-primary');
                            element.classList.add('btn-default');
                        }
                        let date = this.dataset.date;
                        this.classList.remove('btn-default');
                        this.classList.add('btn-primary');
                        soares_sales.inputDateEnd.val(date);
                        soares_sales.form.submit();
                    });
                },
                renderDataLocation(values,index)
                {
                    if(values == undefined)
                    {
                        return;
                    }
                    index++;
                    $('div[data-location="'+index+'"] p').text(values.location);
                    $('div[data-location="'+index+'"] h3 span').text("R$"+values.total.replace('.',','));
                },
                ajaxByLocalizacao() {
                    $.ajax({
                        url: "/api/mapsales?date_start=" + this.dateStart +
                            "&date_end=" + this.dateEnd +
                            "&payments_form=" + this.payments_form +
                            "&user=" + this.selectUser.val(),
                        type: 'GET',
                        success: (e) => {
                            this.renderDataLocation(e[0],0);
                            this.renderDataLocation(e[1],1);
                            this.renderDataLocation(e[2],2);
                            this.renderDataLocation(e[3],3);
                            this.chartPorLocalizacao(e);
                        }
                    });
                },
                ajaxGetUsers() {
                    $.ajax({
                        url: this.url,
                        type: 'GET',
                        success: (e) => {
                            this.selectUser.val('');
                            let data = [];
                            let html = '<option value="">Todos</option>';
                            for (const key in e) {
                                if (soares_sales.getUser == e[key].id) {
                                    html += '<option selected value="' + e[key].id + '">' + e[key]
                                        .email +
                                        '</option>';
                                } else {
                                    html += '<option value="' + e[key].id + '">' + e[key].email +
                                        '</option>';
                                }
                            }
                            this.selectUser.html(html);
                        },
                        complete: (e) => {}
                    });
                },
                ajaxGetPaymentsForm() {
                    $.ajax({
                        url: '/api/payments',
                        type: 'GET',
                        success: (e) => {
                            this.paymentsForm.val('');
                            let data = [];
                            let html = '<option value="">Todos</option>';
                            for (const key in e) {
                                if (soares_sales.payments_form == e[key].name) {
                                    html += '<option selected value="' + e[key].name + '">' + e[key]
                                        .name +
                                        '</option>';
                                } else {
                                    html += '<option value="' + e[key].name + '">' + e[key].name +
                                        '</option>';
                                }
                            }
                            this.paymentsForm.html(html);
                        },
                        complete: (e) => {}
                    });
                },
                getUsers() {
                    this.url = "/api/franqueados";
                    this.ajaxGetUsers();
                },
                init() {
                    this.ajaxGetPaymentsForm();
                    this.getUsers();
                    this.clickInInterval();
                    this.ajaxByLocalizacao();
                }

            };
            soares_sales.init();

        });
    </script>
@stop
