<?php

use Illuminate\Support\Facades\Session;
?>
@extends('admin.admin_layout')

@section('admin_content')




<div class="row-fluid sortable">
    <div class="col-md-12" style="padding: 40px;">

        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon edit"></i><span class="break"></span>Informação da Empresa</h2>
        </div>
        <div class="box-content">
            <div class="col-md-5 dashimg">
                <img style="width: 80%" src="{{asset('images/logo/AidaFloresCabeleireiroLogoLettersBluePng.png')}}" alt="" />
            </div>
            <div class="col-md-6 infodashdiv">
                <div class="infodash">
                    <h4>Nome da Empresa:</h4>
                    <p class="infodashp">Aida Arminda Ramos, Unipessoal LDA</p>
                </div>
                <div class="infodash">
                    <h4>Número de Indentificação Físcal:</h4>
                    <p class="infodashp">513417656</p>
                </div>
                <div class="infodash">
                    <h4>Número de Segurança Social:</h4>
                    <p class="infodashp">25134176567</p>
                </div>
                <div class="infodash">
                    <h4>Morada:</h4>
                    <p class="infodashp">Rua Alves Redol, nº431, r/c, 4050-043 Porto</p>
                </div>
            </div>

        </div>
    </div>
    <!--/span-->

</div>
<!--/row-->




@endsection