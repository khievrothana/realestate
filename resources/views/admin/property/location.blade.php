@extends('layout.master')

@section('css')
     <link href="{{asset('css/iCheck/iCheck.css')}}" rel="stylesheet" />
@stop

@section('content')

  <section class="content-header">
    <h1>
        Property Types
        <small>List</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Property Location</li>
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
                      <table class="table">
                        <tr>
                          <td style="width:120px;"> Location Name : </td>
                          <td> <input type="text" class="form-control input-sm"> </td>
                        </tr>
                        <tr>
                           <td style="width:120px;"> Description : </td>
                          <td> 
                               <textarea class="form-control" rols="3"></textarea>
                          </td>
                        </tr>
                        <tr>
                          <td colspan="2"> <center><button class="btn btn-primary btn-sm"> Save </button></center>
                        </tr>
                      </table>
                  </div>
                  </div>
                  </div>

              <div class="col-xs-8">
                <div class="box box-primary">
                  <div class="box-header with-border">
                    <h3 class="box-title">Listing </h3>
                  </div>
                  <div class="box-body">
                    <div class="location-choice">
                    <label><input type="radio" value="0" name="location" checked id="location"> City/Province</label>
                    <label><input type="radio" value="1" name="location" id="location"> Khan/Distric</label>
                    <label><input type="radio" value="2" name="location" id="location"> SangKate/Commune </label>
                    <label><input type="radio" value="3" name="location" id="location"> Krom/Village</label>
                  </div>
                   <select class="form-control" id="select-location">
                     
                   </select>
                  <br>
                  <table class="table table-border table-location">
                    <tr>
                      <td style="width:190px;">Location Name </td>
                      <td> Deciption</td>
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
<script type="text/javascript" src='{{asset("js/property/location.js")}}'></script>
<script type="text/javascript">
  $(".sidebar-menu").find("li").removeClass("active");
  $(".menu-property").addClass('active').find("ul").addClass("active menu-open").css("display","block").find('li:nth-child(5) a').css('color','#fff');
</script>
@stop