<?php

use Illuminate\Support\Facades\Session;
?>
@extends('admin.admin_layout')

@section('admin_content')

<ul class="breadcrumb">
    <li>
        <i class="icon-home"></i>
        <a href="{{URL::to('/dashboard')}}">Dashboard</a>
        <i class="icon-angle-right"></i>
    </li>
    <li>
        <i class="icon-edit"></i>
        <a href="#">Edit Slider</a>
    </li>
</ul>

<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon edit"></i><span class="break"></span>Edit Slider</h2>
        </div>
        <div class="box-content">
            <p class="alert-success">
                <?php
                $message = Session::get('message');
                if ($message) {
                    echo $message;
                    Session::put('message', null);
                }
                ?>
            </p>
            <form class="form-horizontal" action="{{url('/update-slider/'.$slider_info->slider_id)}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <fieldset>
                    <div class="control-group">
                        <label class="control-label" for="date01">Slider h1</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge" name="slider_h1" value="{{$slider_info->slider_h1}}">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="date01">Slider h2</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge" name="slider_h2" value="{{$slider_info->slider_h2}}">
                        </div>
                    </div>

                    <div class="control-group hidden-phone">
                        <label class="control-label" for="textarea2">Slider Description</label>
                        <div class="controls">
                            <textarea class="cleditor" name="slider_description" rows="3">{{$slider_info->slider_description}}</textarea>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="fileInput">Slider Image</label>
                        <div class="controls">
                            <input class="input-file uniform_on" id="fileInput" name="slider_image" type="file">
                        </div>
                    </div>
                    <div class="control-group hidden-phone">
                        <label class="control-label" for="textarea2">Publication Status</label>
                        <div class="controls">
                            @if($slider_info->publication_status==1)
                            <input type="checkbox" name="publication_status" value="1" checked>
                            @else
                            <input type="checkbox" name="publication_status" value="1">
                            @endif
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Edit Slider</button>
                        <button type="reset" class="btn"><a href="{{URL::to('/all-slider')}}">Cancel</a></button>
                    </div>
                </fieldset>
            </form>

        </div>
    </div>
    <!--/span-->

</div>
<!--/row-->

@endsection