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
        <table class="table">
          <tr>
            <td style="width:120px;"> Property Type : </td>
            <td> <input type="text" class="form-control input-sm"> </td>
          </tr>
          <tr>
           <td style="width:120px;"> Type Slug : </td>
           <td> <input type="text" class="form-control input-sm"> </td>
         </tr>
         <tr>
           <td style="width:120px;"> Parents : </td>
           <td> 
            <select class="form-control input-sm">
              <option>  </option>
              <option> Apartments</option>
            </select>
          </td>
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
      <div class="input-group">
        <input type="text" name="table_search" id="searchWord" class="form-control input-sm pull-left" placeholder=" ">
        <div class="input-group-btn">
          <button type="button" class="btn btn-sm btn-default fs12 searchButton"><i class="fa fa-search"></i></button>
        </div>
      </div>
      <br>
      <table class="table table-border">
        <tr>
          <td style="width:190px;"> Name </td>
          <td> Deciption</td>
          <td> Slug </td>
          <td style="width:130px;"> Delete </td>
        </tr>
        
        <tr>
          <td>  <label><input type="radio"> Apartment</label> </td>
          <td> Deciption</td>
          <td> Slug </td>
          <td> <button class="btn btn-danger btn-xs"> <i class="fa fa-trash-o"></i> Delete</button> <button class="btn btn-primary btn-xs"> <i class="fa fa-pencil-square-o"></i> Edit</button> </td>
        </tr>
        <tr>
          <td>  <label> __ <input type="radio"> Small Apartment</label> </td>
          <td> Deciption</td>
          <td> Slug </td>
          <td> <button class="btn btn-danger btn-xs"> <i class="fa fa-trash-o"></i> Delete</button> <button class="btn btn-primary btn-xs"> <i class="fa fa-pencil-square-o"></i> Edit</button> </td>
        </tr>
        <tr>
          <td>  <label><input type="radio"> __Small Apartment</label> </td>
          <td> Deciption</td>
          <td> Slug </td>
          <td> <button class="btn btn-danger btn-xs"> <i class="fa fa-trash-o"></i> Delete</button> <button class="btn btn-primary btn-xs"> <i class="fa fa-pencil-square-o"></i> Edit</button> </td>
        </tr>
        <tr>
          <td>  <label><input type="radio"> __Small Apartment</label> </td>
          <td> Deciption</td>
          <td> Slug </td>
          <td> <button class="btn btn-danger btn-xs"> <i class="fa fa-trash-o"></i> Delete</button> <button class="btn btn-primary btn-xs"> <i class="fa fa-pencil-square-o"></i> Edit</button> </td>
        </tr>
        <tr>
          <td>  <label><input type="radio"> __Small Apartment</label> </td>
          <td> Deciption</td>
          <td> Slug </td>
          <td> <button class="btn btn-danger btn-xs"> <i class="fa fa-trash-o"></i> Delete</button> <button class="btn btn-primary btn-xs"> <i class="fa fa-pencil-square-o"></i> Edit</button> </td>
        </tr>
        <tr>
          <td>  <label><input type="radio"> __Small Apartment</label> </td>
          <td> Deciption</td>
          <td> Slug </td>
          <td> <button class="btn btn-danger btn-xs"> <i class="fa fa-trash-o"></i> Delete</button> <button class="btn btn-primary btn-xs"> <i class="fa fa-pencil-square-o"></i> Edit</button> </td>
        </tr>

      </table>
    </div>
  </div>
</div>
</section>

@stop

@section('javascript')
<script type="text/javascript" src='{{asset("js/Plugins/iCheck/icheck.js")}}'></script>
<script type="text/javascript" src='{{asset("js/property.js")}}'></script>
<script type="text/javascript">
  $(".sidebar-menu").find("li").removeClass("active");
  $(".menu-property").addClass('active').find("ul").addClass("active menu-open").css("display","block").find('li:nth-child(4) a').css('color','#fff');
</script>
@stop