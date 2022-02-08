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
                                <!--
                                                    <div class="col-sm-12">
                                                        <div id="dataTable_filter" class="dataTables_filter">
                                                            <label>
                                                                <button id="download_excel" class="btn btn-primary">BAIXAR (CSV)</button>
                                                            </label>
                                                        </div>
                                                    </div>
                                                -->
                                <div class="col-sm-12">
                                    <form method="GET">
                                        <div class="dataTables_length" id="dataTable_length">
                                            <label>
                                                Data de início
                                                <input value="{{ $date_start }}" type="date" class="form-control input-sm"
                                                    name="date_start" id="date_start" />
                                            </label>
                                            <label>
                                                Data final
                                                <input value="{{ $date_end }}" type="date" class="form-control input-sm"
                                                    name="date_end" id="date_end" />
                                            </label>
                                            <label>
                                                <button class="btn btn-success" id="buscar">Buscar</button>
                                            </label>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12" id="results">
                                    <div id="chartContainer" style="height: 370px; max-width:100%; margin: 0px auto;">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">

                                </div>
                            </div>
                            <div class="row" id="divMonthsMoney" class="justify-content-center">

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
                divMonthsMoney: $('#divMonthsMoney'),
                user_id: "{{ Auth::User()->id }}",
                email: "{{ Auth::User()->email }}",
                dateStart: "{{ $date_start }}",
                dateEnd: "{{ $date_end }}",
                chartContainer: 'chartContainer',
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
                    const data = [];
                    this.dataPointsKey.map((nameStatus)=>{
                        data.push(
                            {
                                type: "bar",
                                name: nameStatus,
                                yValueFormatString: "#,### Reais",
                                dataPoints: this.dataPoints[nameStatus],
                            }
                        )
                    });
                    chart = new CanvasJS.Chart(this.chartContainer, {
                        animationEnabled: true,
                        theme: "line",
                        title: {
                            text: "Gráfico de Vendas"
                        },
                        toolTip: {
                            shared: true
                        },
                        axisY: {
                            title: "R$",
                            titleFontSize: 24
                        },
                        locale : 'pt-BR',
                        data: data
                    });
                    chart.render();
                },
                ajax() {
                    $.ajax({
                        url: this.url,
                        type: 'GET',
                        success: (e) => {
                            for (var i = 0; i < e.length; i++) {
                                this.dataPoints.push({
                                    x: new Date(e[i][0]),
                                    y: e[i][1]
                                });
                            }
                        },
                        complete: (e) => {
                            this.chart();
                        }
                    });
                },
                ajaxByDateAndStatus() {
                    $.ajax({
                        url: this.url,
                        type: 'GET',
                        success: (object) => {
                            let noExistData = true;
                            for (const status in object) {
                                noExistData = false;
                                const date = Object.keys(object[status])[0];
                                const value = Object.values(object[status])[0];
                                if (this.dataPoints[status] == undefined) {
                                    this.dataPoints[status] = [];
                                }
                                this.dataPoints[status].push({
                                    x: new Date(date),
                                    y: value
                                })
                            }
                            if(noExistData)
                            {
                                if(this.dataPoints['Nenhuma venda'] == undefined){
                                    this.dataPoints['Nenhuma venda'] = [];
                                }
                                this.dataPoints['Nenhuma venda'].push({
                                    x: new Date(this.dateStart),
                                    y: 0
                                })
                                this.dataPoints['Nenhuma venda'].push({
                                    x: new Date(this.dateEnd),
                                    y: 0
                                })
                            }
                            this.dataPointsKey = Object.keys(this.dataPoints);
                        },
                        complete: (e) => {
                            this.chart();
                        }
                    });
                },
                ajaxByStatus() {
                    $.ajax({
                        url: this.url,
                        type: 'GET',
                        success: (e) => {
                            for (let value in e) {
                                let html = `
                                <div class="card col-md-3">
                                    <h5>${value}</h5>
                                    <div class="card-body">
                                        R$ ${e[value].replace('.',',')}
                                    </div>
                                </div>
                                `;
                                this.divMonthsMoney.append(html);
                            }
                        },
                        complete: (e) => {}
                    });
                },
                getByStatus() {
                    this.url = "/api/order_by_status";
                    this.ajaxByStatus();
                },
                getMoneyByDateAndStatusInterval() {
                    this.url = "/api/total_by_interval?mounths=" + this.months();
                    this.ajaxByDateAndStatus();
                },
                getMoneyOfYear() {
                    this.url = "/api/total_by_interval?mounths=" + this.months();
                    this.ajax();
                },
                init() {
                    this.getMoneyByDateAndStatusInterval();
                    //this.getMoneyOfYear();
                    this.getByStatus();
                }

            };
            soares_sales.init();

        });
    </script>
@stop
