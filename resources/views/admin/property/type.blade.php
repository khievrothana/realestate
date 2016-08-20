@extends('layout.master')

@section('css')
     <link href="{{asset('css/iCheck/iCheck.css')}}" rel="stylesheet" />
     <link href="{{asset('css/bootstrap/bootstrapValidator.css')}}" rel="stylesheet" />
@stop

@section('content')

	<section class="content-header">
    <h1>
        Property Types
        <small>List</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Property Types</li>
    </ol>
</section>
<section class="content"> 
  <div class="row">
                 <div class="col-md-4">
                  <div class="box box-primary">
                  <div class="box-header with-border">
                    <h3 class="box-title">Basic Information</h3>
                  </div>
                  <div class="box-body">
                    <form id="mainForm">
                      <table class="table">
                        <tr>
                          <td style="width:120px;"> Property Type : </td>
                          <td> 
                            <div class="form-group input-group">
                               <input type="hidden" name="_token" value="{{ csrf_token() }}">
                              <input name="name" type="text" class="form-control input-sm">
                            </div>
                         </td>
                        </tr>
                        <tr>
                           <td style="width:120px;"> Type Slug : </td>
                          <td> <input name="slug" type="text" class="form-control input-sm"> </td>
                        </tr>
                        <tr>
                           <td style="width:120px;"> Description : </td>
                          <td> 
                               <textarea name="description" class="form-control" cols="3"></textarea>
                          </td>
                        </tr>
                        <tr>
                          <td colspan="2"> <center><button class="btn btn-primary btn-sm save" type="submit"> Save </button> <button class="btn btn-primary btn-sm clear"> Clear </button></center>
                        </tr>
                      </table>
                      </form>
                  </div>
                  </div>
                  </div>

              <div class="col-xs-8">
                <div class="box box-primary">
                  <div class="box-header with-border">
                    <h3 class="box-title">Listing </h3>
                  </div>
                  <div class="box-body">
                  <div class="input-group">
                    <input type="text" name="table_search" id="searchWord" class="form-control input-sm pull-left" placeholder=" ">
                    <div class="input-group-btn">
                      <button type="button" class="btn btn-sm btn-default fs12 searchButton"><i class="fa fa-search"></i></button>
                    </div>
                  </div>
                  <br>
                  <table class="table table-border table-list">
                    <tr>
                      <td style="width:190px;"> Name </td>
                      <td> Deciption</td>
                      <td> Slug </td>
                      <td style="width:130px;"> Delete </td>
                    </tr>

                  </table>
              </div>
            </div>
            </div>
</section>

@stop

@section('javascript')
<script type="text/javascript" src='{{asset("js/Plugins/iCheck/icheck.js")}}'></script>
<script src="{{asset('js/Plugins/bootstraps/bootstrapValidator.js')}}"></script>
<script type="text/javascript" src='{{asset("js/property/type.js")}}'></script>
<script type="text/javascript">
  $(".sidebar-menu").find("li").removeClass("active");
  $(".menu-property").addClass('active').find("ul").addClass("active menu-open").css("display","block").find('li:nth-child(3) a').css('color','#fff');
</script>
@stop