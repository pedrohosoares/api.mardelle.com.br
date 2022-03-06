@extends('voyager::master')

@section('page_title', __('voyager::generic.viewing') . ' ' . __('Clientes'))
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
        <i class="voyager-person">
        </i> {{ __('Add Usuário') }}
    </h1>
@stop

@section('content')
    <div class="page-content settings container-fluid">

        <div style="clear:both">
        </div>

    </div>
    <div class="page-content container-fluid">
            @if (isset($dataTypeContent))
            @php
                $params = "/".$dataTypeContent->id;
            @endphp
            @endif
        <form class="form-edit-add" role="form" action="/admin/users{{ $params }}" method="POST" enctype="multipart/form-data"
            autocomplete="off">
            <!-- PUT Method if we are editing -->
            @csrf
            @if (!empty($dataTypeContent->name))
                <input type="hidden" name="_method" value="PUT">
            @else
                <input type="hidden" name="_method" value="POST">
            @endif
            <input type="hidden" name="avatar" value="users/default.png" />
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-bordered">
                        <div class="panel-body">
                            <div class="form-group">
                                <label for="name">Nome</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Name"
                                    value="{{ isset($dataTypeContent->name) ? $dataTypeContent->name : '' }}">
                            </div>
                            <div class="form-group">
                                <label for="email">E-mail</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="E-mail"
                                    value="{{ isset($dataTypeContent->email) ? $dataTypeContent->email : '' }}">
                            </div>
                            <div class="form-group">
                                <label for="porcentage_gain">Porcentagem de ganho por CEP</label>
                                <input type="number" min="0" class="form-control" id="porcentage_gain"
                                    name="porcentage_gain" placeholder="Porcentagem de ganho"
                                    value="{{ isset($dataTypeContent->porcentage_gain) ? $dataTypeContent->porcentage_gain : '' }}" />
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" value=""
                                    autocomplete="new-password">
                            </div>
                            <div class="form-group">
                                <label for="default_role">Default Role</label>
                                <select class="form-control select2-ajax select2-hidden-accessible" name="role_id"
                                    data-get-items-route="/admin/users/relation"
                                    data-get-items-field="user_belongsto_role_relationship" data-method="add"
                                    data-select2-id="3" tabindex="-1" aria-hidden="true">

                                    <option value="" data-select2-id="5">None</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="additional_roles">Additional Roles</label>
                                <select class="form-control select2-ajax select2-hidden-accessible"
                                    name="user_belongstomany_role_relationship[]" multiple=""
                                    data-get-items-route="/admin/users/relation"
                                    data-get-items-field="user_belongstomany_role_relationship" data-method="add"
                                    data-select2-id="6" tabindex="-1" aria-hidden="true">
                                    <option value="" data-select2-id="8">None</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="locale">Locale</label>
                                <select class="form-control select2 select2-hidden-accessible" id="locale" name="locale"
                                    data-select2-id="locale" tabindex="-1" aria-hidden="true">
                                    <option value="al">al</option>
                                    <option value="am">am</option>
                                    <option value="ar">ar</option>
                                    <option value="bg">bg</option>
                                    <option value="ca">ca</option>
                                    <option value="cs">cs</option>
                                    <option value="de">de</option>
                                    <option value="el">el</option>
                                    <option value="en" selected="" data-select2-id="2">en</option>
                                    <option value="es">es</option>
                                    <option value="fa">fa</option>
                                    <option value="fi">fi</option>
                                    <option value="fr">fr</option>
                                    <option value="gl">gl</option>
                                    <option value="id">id</option>
                                    <option value="it">it</option>
                                    <option value="ja">ja</option>
                                    <option value="ku">ku</option>
                                    <option value="nl">nl</option>
                                    <option value="pl">pl</option>
                                    <option value="pt">pt</option>
                                    <option value="pt_br">pt_br</option>
                                    <option value="ro">ro</option>
                                    <option value="ru">ru</option>
                                    <option value="sv">sv</option>
                                    <option value="tr">tr</option>
                                    <option value="uk">uk</option>
                                    <option value="vi">vi</option>
                                    <option value="zh_CN">zh_CN</option>
                                    <option value="zh_TW">zh_TW</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

            <button type="submit" class="btn btn-primary pull-right save">
                Save
            </button>
        </form>

        <iframe id="form_target" name="form_target" style="display:none">
        </iframe>
        <form id="my_form" action="http://localhost:8000/admin/upload" target="form_target" method="post"
            enctype="multipart/form-data" style="width:0px;height:0;overflow:hidden">
            <input type="hidden" name="_token" value="32W6Lhj5PfWX1ysqZAaPBWYzk6N7iUVqgNZ7kAXM">
            <input name="image" id="upload_file" type="file" onchange="$('#my_form').submit();this.value='';">
            <input type="hidden" name="type_slug" id="type_slug" value="users">
        </form>
    </div>
@stop


@section('javascript')
    <script>
        jQuery(document).ready(function($) {

            const soares_leads = {
                user_id: "{{ Auth::User()->id }}",
                email: "{{ Auth::User()->email }}",
                url: "",
                init() {
                    this.url = '/admin/relatorio-busca?localizacao=' + this.localizacao_feira.val() +
                        '&expositor=' + this.expositor_feira.val() + "&cliente=" + this.cliente_feira.val();
                }

            };

        });
    </script>
    <form id="my_form" action="{{ route('voyager.upload') }}" target="form_target" method="POST"
        enctype="multipart/form-data" style="width:0;height:0;overflow:hidden">
        {{ csrf_field() }}
        <input name="image" id="upload_file" type="file" onchange="$('#my_form').submit();this.value='';">
        <input type="hidden" name="type_slug" id="type_slug" value="settings">
    </form>
@stop
