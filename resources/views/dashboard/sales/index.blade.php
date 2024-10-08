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
        <i class="voyager-settings">
        </i> {{ __('Vendas') }}
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
                                        <button data-now="{{ date('Y-m-d', strtotime(simpleDateRight())) }}"
                                            data-date="{{ date('Y-m-d', strtotime('+1 month', strtotime(simpleDateRight()))) }}"
                                            class="btn btn-default btnDate">1 mês</button>
                                    </label>
                                    <label>
                                        <br />
                                        <button data-now="{{ date('Y-m-d', strtotime(simpleDateRight())) }}"
                                            data-date="{{ date('Y-m-d', strtotime('+15 days', strtotime(simpleDateRight()))) }}"
                                            class="btn btn-default btnDate">15 dias</button>
                                    </label>
                                    <label>
                                        <br />
                                        <button data-now="{{ date('Y-m-d', strtotime(simpleDateRight())) }}"
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
                                <div class="card text-center col-md-3">
                                    <p>Valor total</p>
                                    <span>
                                        <span>Comissão:</span><br />
                                        <span id="comissionTotal">R$0,00</span>
                                    </span>
                                    <h3 style="padding-left:20px;">
                                        <span id="totalValue">0</span>
                                    </h3>
                                </div>
                                <div class="card text-center col-md-3">
                                    <p>Ticket médio</p>
                                    <span>
                                        <span>Comissão:</span><br />
                                        <span id="comissionTicketMedium">R$0,00</span>
                                    </span>
                                    <h3 style="padding-left:20px;">
                                        <span id="mediumValue">R$0,00</span>
                                    </h3>
                                </div>
                                <div class="card text-center col-md-3">
                                    <p>Total de clientes</p>
                                    <h3 style="padding-left:20px;">
                                        <span id="total_clientes">0</span>
                                    </h3>
                                </div>
                                <div class="card text-center col-md-3">
                                    <p>Produtos Vendidos</p>
                                    <h3 style="padding-left:20px;">
                                        <span id="total_vendas">0</span>
                                    </h3>
                                </div>
                            </div>
                            <div class="row" style="margin-top:40px;">
                                <div class="col-md-6">
                                    <div class="card text-center col-md-12">
                                        <br />
                                        <div id="meios_pagamentos" style="height: 370px; max-width:100%; margin: 0px auto;">

                                        </div>
                                        <br />
                                        <div id="status_pagamentos"
                                            style="height: 370px; max-width:100%; margin: 0px auto;">

                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6" id="results">
                                    <br />
                                    <div id="chartContainer" style="height: 370px; max-width:100%; margin: 0px auto;">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                            </div>
                            <div class="row">
                                <div class="col-sm-12">

                                </div>
                            </div>
                            <div class="row" class="justify-content-center">
                                <div class="col-sm-6" id="divMonthsMoney">

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
                inputDateStart: $('input[name="date_start"]'),
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
                comissionTotal: $('#comissionTotal'),
                comissionTicketMedium: $('#comissionTicketMedium'),
                userPorcentage(){
                    return parseFloat(
                        $('#selectUser option[value="'+this.getUser+'"]').attr('data-porcentage')
                    );
                },
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
                chart() {
                    chart = new CanvasJS.Chart(this.chartContainer, {
                        animationEnabled: true,
                        title: {
                            text: "Vendas pelo tempo"
                        },
                        axisY: {
                            title: "Vendas em R$",
                            valueFormatString: "###.##",
                            suffix: "mn",
                            prefix: "R$",
                        },
                        data: [{
                            type: "splineArea",
                            color: "rgba(54,158,173,.7)",
                            markerSize: 5,
                            yValueFormatString: "R$###.##",
                            dataPoints: this.dataPoints
                        }]
                    });
                    chart.render();
                },
                chartMeiosPagamentos(object) {
                    let newObject = [];
                    object.forEach((v) => {
                        newObject.push({
                            y: parseFloat(v.total),
                            label: v.payment_form
                        });
                    });
                    chart = new CanvasJS.Chart(this.meios_pagamentos, {
                        animationEnabled: true,

                        title: {
                            text: "Meios de pagamentos"
                        },
                        axisX: {
                            interval: 1
                        },
                        axisY2: {
                            interlacedColor: "rgba(1,77,101,.2)",
                            gridColor: "rgba(1,77,101,.1)",
                            title: "Valores em R$"
                        },
                        data: [{
                            type: "bar",
                            name: "companies",
                            axisYType: "secondary",
                            color: "#014D65",
                            dataPoints: newObject
                        }]
                    });
                    chart.render();
                },
                chartPorStatus(object) {
                    let dataPoints = [];
                    object.forEach((v) => {
                        dataPoints.push({
                            y: parseFloat(v.total),
                            name: v.status
                        });
                    });
                    const chart = new CanvasJS.Chart(this.status_pagamentos, {
                        exportEnabled: true,
                        animationEnabled: true,
                        title: {
                            text: "Status dos pagamentos"
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
                        let now = this.dataset.now;
                        let date = this.dataset.date;
                        let newDate = now.replace(/-/g, ',');
                        newDate = new Date(newDate);
                        newDate = newDate.toLocaleDateString('pt-BR').split('/').reverse().join('-');
                        soares_sales.inputDateStart.val(newDate);
                        this.classList.remove('btn-default');
                        this.classList.add('btn-primary');
                        soares_sales.inputDateStart.val(now);
                        soares_sales.inputDateEnd.val(date);
                        //soares_sales.form.submit();
                    });
                },
                ajaxTotalValue() {
                    $.ajax({
                        url: "/api/total/payments?date_start=" + this.dateStart +
                            "&date_end=" + this.dateEnd +
                            "&payments_form=" + this.payments_form +
                            "&user=" + this.user,
                        type: 'GET',
                        success: (e) => {
                            let valuePorcentage = parseFloat(e[0].total) * (this.userPorcentage() / 100);
                            valuePorcentage = "R$" + valuePorcentage.toFixed(2).replace('.', ',');
                            this.comissionTotal.text(valuePorcentage);
                            e = "R$" + parseFloat(e[0].total).toFixed(2).replace('.', ',');
                            this.totalValue.text(e);
                        }
                    });
                },
                ajaxMediumTicket() {
                    $.ajax({
                        url: "/api/total/medium_ticket?date_start=" + this.dateStart +
                            "&date_end=" + this.dateEnd +
                            "&payments_form=" + this.payments_form +
                            "&user=" + this.user,
                        type: 'GET',
                        success: (e) => {
                            let valuePorcentage = parseFloat(e[0].total) * (this.userPorcentage() / 100);
                            valuePorcentage = "R$" + valuePorcentage.toFixed(2).replace('.', ',');
                            this.comissionTicketMedium.text(valuePorcentage);
                            e = "R$" + parseFloat(e[0].total).toFixed(2).replace('.', ',');
                            this.mediumValue.text(e);
                        }
                    });
                },
                ajaxByDateAndStatus() {
                    $.ajax({
                        url: this.url,
                        type: 'GET',
                        success: (object) => {
                            object.forEach(function(v, i) {
                                soares_sales.dataPoints.push({
                                    x: new Date(v.date),
                                    y: parseInt(v.total)
                                })
                            });
                        },
                        complete: (e) => {
                            this.chart();
                        }
                    });
                },
                ajaxByStatus() {
                    $.ajax({
                        url: "/api/sales/total/status?date_start=" + this.dateStart +
                            "&date_end=" + this.dateEnd +
                            "&payments_form=" + this.payments_form +
                            "&user=" + this.user,
                        type: 'GET',
                        success: (e) => {
                            this.chartPorStatus(e);
                        }
                    });
                },
                ajaxByTotalSales() {
                    $.ajax({
                        url: "/api/sales/total/sales?date_start=" + this.dateStart +
                            "&date_end=" + this.dateEnd +
                            "&payments_form=" + this.payments_form +
                            "&user=" + this.user,
                        type: 'GET',
                        success: (e) => {
                            this.total_vendas.text(e[0].total);
                        }
                    });
                },
                ajaxByTotalClients() {
                    $.ajax({
                        url: "/api/sales/total/clients?date_start=" + this.dateStart +
                            "&date_end=" + this.dateEnd +
                            "&payments_form=" + this.payments_form +
                            "&user=" + this.user,
                        type: 'GET',
                        success: (e) => {
                            this.total_clientes.text(e[0].total);
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
                            let html = '';
                            for (const key in e) {
                                if (soares_sales.getUser == e[key].id) {
                                    html += '<option selected data-porcentage="'+e[key].porcentage_gain+'" value="' + e[key].id + '">' + e[key]
                                        .email +
                                        '</option>';
                                } else {
                                    html += '<option data-porcentage="'+e[key].porcentage_gain+'" value="' + e[key].id + '">' + e[key].email +
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
                ajaxApiSalesTotalPayment() {
                    $.ajax({
                        url: "/api/sales/total/payment?date_start=" + this.dateStart +
                            "&date_end=" + this.dateEnd +
                            "&payments_form=" + this.payments_form +
                            "&user=" + this.user,
                        type: 'GET',
                        success: (object) => {
                            this.chartMeiosPagamentos(object);
                        },
                        complete: (e) => {

                        }
                    });
                },
                getMoneyByDateAndStatusInterval() {
                    this.url = "/api/all_sales?date_start=" + this.dateStart +
                        "&date_end=" + this.dateEnd +
                        "&payments_form=" + this.payments_form +
                        "&user=" + this.user;
                    this.ajaxByDateAndStatus();
                },
                getMoneyOfYear() {
                    this.ajaxTotalValue();
                },
                getUsers() {
                    this.url = "/api/franqueados";
                    this.ajaxGetUsers();
                },
                init() {
                    this.getUsers();
                    this.getMoneyByDateAndStatusInterval();
                    this.getMoneyOfYear();
                    this.ajaxGetPaymentsForm();
                    this.clickInInterval();
                    this.ajaxMediumTicket();
                    this.ajaxApiSalesTotalPayment();
                    this.ajaxByStatus();
                    this.ajaxByTotalClients();
                    this.ajaxByTotalSales();
                }

            };
            soares_sales.init();

        });
    </script>
@stop
