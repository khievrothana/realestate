@extends('layout.master')

@section('css')
     <link href="{{asset('css/iCheck/iCheck.css')}}" rel="stylesheet" />
     <link href="{{asset('css/sweetAlert/sweetalert.css')}}" rel="stylesheet" />
     <style type="text/css">
      .table p{
    font-size: 14px;
    }
     </style>
@stop

@section('content')

	<section class="content-header">
    <h1>
        Property
        <small>List</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Property</li>
    </ol>
</section>
<section class="content"> 
            <div class='box'>
            <div class="row">
            <div class="box-body">
              <div class="col-xs-4">
                  <div class="input-group">
                    <input type="text" name="" id="searchWord" class="form-control input-sm pull-left" placeholder=" ">
                    <div class="input-group-btn">
                      <button type="button" class="btn btn-sm btn-default searchButton"><i class="fa fa-search"></i></button>
                    </div>
                  </div>
                  <div id="searchSelecter" style="padding-top:5px;">
                    <label class="hover">
                        <input type='radio' value="0" name="stausType" checked> All
                    </label>
                    <label class="hover">
                        <input type='radio' value="1" name="stausType"> On Sale
                    </label>
                    <label class="">
                       <input type='radio' value="2" name="stausType"> On Rent
                   </label>
                     
                  </div>
                <!--//input-group-->
            </div>
            <!--//col-->   
            <div class="col-xs-6">
                <div id="searchSelecter" style="padding-top:5px;">
                  <p style="display:inline-flex;"><span style="padding-top: 7px;">Property Type：</span>
                    <select id="Type" class="form-control input-sm" style="width: 280px;">
                      <option value="0">All </option>
                    </select>
                  </p>
                </div>
            </div>
            <!--//col-->
            <div class="col-xs-2" style="float:right;">
              <button type="button" id="addSearch" class="btn btn-default btn-block btn-flat">Advanc Search</button>
            </div>
            </div>
            <!--./box-body--> 
          </div>
        </div>

        <div class="box"> 
            <!-- box-body -->
            <div class="box-header">
              <h3 class="box-title"><i class="fa fa-cubes"></i>Property List</h3>
              <div class="box-tools ajaxPager">
                <div class="box-tools">
                   <ul class="pagination pagination-sm no-margin pull-right">
                        <li><span>0Page〜0Page (All)</span></li>
                        <li><a href="#" data-pagination="0" id="p1">«</a></li>
                        <li><a href="#" data-pagination="0" id="p2">0</a></li>
                        <li class="active"><a href="#" data-pagination="1" id="p3">1</a></li>
                        <li><a href="#" data-pagination="2" id="p4">2</a></li>
                        <li><a href="#" data-pagination="2" id="p5">»</a></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="box-body">
              <div class="ajaxTable" style="clear:both;">
                <a href="property/addnew"   data-name="Add New" data-url="property/edit">
                  <button type="button" class="btn btn-primary btn-sm" > <i class="fa fa-pencil"></i> Add New Property</button>
                  </a> 
                  <a href="#">
                  <button type="button" class="btn btn-primary btn-sm delete" > <i class="fa fa-trash-o"></i> Delete </button>
                  </a> 

                  <div class="btn-group">
                     <button type="button" class="btn btn-primary btn-sm displayNumberText">Display Number</button>
                            <button type="button" class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown"> <span class="caret"></span> <span class="sr-only">Toggle Dropdown</span> </button>
                            <ul class="dropdown-menu displayNumber" role="menu">
                                <li><a href="#" rel="10">10 Showing</a></li>
                                <li><a href="#" rel="20">20 Showing</a></li>
                                <li><a href="#" rel="50">50 Showing</a></li>
                                <li><a href="#" rel="100">100 Showing</a></li>
                            </ul>
                    </div>
                  </div>
                  <table class="table table-bordered textCenter">
                    <tbody>
                      <tr class="title">
                        <th style="width: 40px;">Edit</th>
                        <th style="width: 40px;"> 
                           <input type="checkbox" class="allChecked"> All
                        </th>
                        <th style="width: 80px;">Image</th>
                        <th >Code</th>
                        <th style="text-align: left;">Name</th>
                        <th style="width: 80px;"> Type</th>
                        <th style="width: 55px;"> Price</th>
                        <th style="width: 80px;"> Status</th>
                        <th style="width: 95px;" >Property Size</th>
                        <th style="width: 110px;">Location</th>
                        <th style="width: 110px;">DateCreated</th>
                        <th style="width: 90px;"> Preview</th>
                      </tr>

                    </tbody>
                  </table>
            </div>
          </div>
</section>

@stop

@section('javascript')
<script type="text/javascript" src='{{asset("js/Plugins/iCheck/icheck.js")}}'></script>
 <script type="text/javascript" src='{{asset("js/Plugins/sweetalert/sweetalert.min.js")}}'></script>
<script type="text/javascript" src='{{asset("js/property/property.js")}}'></script>
<script type="text/javascript">
  $(".sidebar-menu").find("li").removeClass("active");
  $(".menu-property").addClass('active').find("ul").addClass("active menu-open").css("display","block").find('li:nth-child(1) a').css('color','#fff');
</script>
@stop