@extends('layout.master')

@section('css')
<link href="{{asset('css/iCheck/iCheck.css')}}" rel="stylesheet" />
<link href="{{asset('css/bootstrap/bootstrapValidator.css')}}" rel="stylesheet" />
@stop

@section('content')
<section class="content-header">
 <h1>
   Property 
   <small>Add New</small>
 </h1>
 <ol class="breadcrumb">
   <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
   <li class="active">Property/Add</li>
 </ol>
</section>
<section class="content">
  <form id="mainForm">
    <div class="row">
      <div class="col-md-8">
        <div class="box box-primary">
         <div class="box-header with-border">
           <h3 class="box-title">Basic Information</h3>
         </div>
         <div class="box-body">
          <table class="table table-border">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <tr>
              <td style="width:180px;"><p>Property Code</p></td>
              <td>
                <div class="form-group form-input">
                  <input type="text" name="code" class="form-control input-sm">
                </div>
              </td>
            </tr>
            <tr>
              <td style="width:180px;"><p>Property Name</p></td>
              <td>
                <div class="form-group">
                  <input type="text" name="name" class="form-control input-sm">
                </div>
              </td>
            </tr>
            <tr>
              <td style="width:180px;"><p>Property Price ($) </p></td>
              <td>
                <div class="form-group">
                  <input type="text" name="price" class="form-control input-sm">
                </div>
              </td>
            </tr>
            <tr>
              <td style="width:180px;"><p>Property Status</p></td>
              <td>
                <div class="form-group">
                  <label><input type="checkbox" id="onsale"> On Sale </label>
                  <label><input type="checkbox" id="onrent"> On Rent </label>
                </div>
              </td>
            </tr>
            <tr>
              <td style="width:180px;"><p>Property Type</p></td>
              <td>
                <div class="form-group">
                  <select class="form-control" id="propertyType">
                     
                  </select>
                </div>
              </td>
            </tr>
            <tr>
              <td style="width:180px;"><p>Property Size</p></td>
              <td>
                <div class="form-group">
                  <input type="text" name="proeprtySize" class="form-control input-sm">
                </div>
              </td>
            </tr>
            <tr>
              <td style="width:180px;"><p>Land Size</p></td>
              <td>
                <div class="form-group">
                  <input type="text" name="landSize" class="form-control input-sm">
                </div>
              </td>
            </tr>
            <tr>
              <td style="width:180px;"><p>Bed Rooms</p></td>
              <td>
                <div class="form-group">
                  <input type="text" name="bedRoom" class="form-control input-sm">
                </div>
              </td>
            </tr>
            <tr>
              <td style="width:180px;"><p>Bath Rooms</p></td>
              <td>
                <div class="form-group">
                  <input type="text" name="bathRoom" class="form-control input-sm">
                </div>
              </td>
            </tr>
            <tr>
              <td colspan="2">
                <p>Decription</p>
                <div class="form-group">
                  <textarea class="form-control" cols="4" id="decription"> </textarea>
                </div>
              </td>
            </tr>
            <tr>
              <td colspan="2" class="property-images">
                <h4>Property Images  </h4>
                <div class="row slider">

                </div>
                <div class="row">
                  <div class="col-md-12">
                    <button class="btn btn-primary btn-sm modalwindow" data-evt="slider" data-url="http://localhost/RealManagerment/public/administrator/image/upload"><i class="fa fa-upload"></i> Upload Images</button>
                  </div>
                </div>
              </td>
            </tr>
            
          </table>
        </div>
      </div>
    </div>
    
    <div class="col-md-4">
      <div class="box box-primary">
       <div class="box-header with-border">
         <h3 class="box-title">Public</h3>
       </div> 
       <div class="box-body">
        <button class="btn btn-primary btn-sm addnew"> <i class="fa fa-file-o"></i> Add New </button>
        <button type="submit" class="btn btn-primary btn-sm save"> <i class="fa fa-floppy-o"></i> Save </button>
        <button class="btn btn-danger btn-sm delete"> <i class="fa fa-trash-o"></i> Delete</button>
        <button class="btn btn-primary btn-sm preview"> <i class="fa fa-search-plus"></i> Previwe </button>

        <div class="box-header with-border">
          <h3 class="box-title">Feature Image</h3>
        </div> 
        <div class="row">
          <div class="col-xs-12 col-md-12">
            <a href="#" class="thumbnail">
              <img class="feature" src="{{asset('uploads/_feature.jpg')}}" alt="...">
            </a>
            <button class="btn btn-primary btn-sm modalwindow" data-evt="feature" data-url="http://localhost/RealManagerment/public/administrator/image/upload" style="margin-buttom:5px;"><i class="fa fa-upload"></i> Upload Feature</button>
          </div>

        </div>
      </div>
    </div>
    <div class="box box-primary">
     <div class="box-header with-border">
       <h3 class="box-title">Location</h3>
     </div>
     <div class="box-body">
       <div class="col-12-sm">
        <p> City/Province </p>
        <div class="form-group">
          <select class="form-control input-sm" id="province">
            <option value=""></option>
          </select>
        </div>
      </div>
      <div class="col-12-sm">
        <p> Khan/District </p>
        <div class="form-group ">
          <select class="form-control input-sm" id="district" disabled>
           <option value=""></option>
          </select>
        </div>
      </div>
      <div class="col-12-sm">
        <p>  Sangkat/Commune </p>
        <div class="form-group ">
          <select class="form-control input-sm" id="commune" disabled>
            <option value=""></option>
          </select>
        </div>
      </div>
      <div class="col-12-sm">
        <p> Korm/Province </p>
        <div class="form-group ">
          <select class="form-control input-sm" id="village" disabled>
           <option value=""></option>
          </select>
        </div>
      </div>
    </div>
  </div>

  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Property Feature</h3>
    </div> 
    <div class="box-body property-feature">
 
    </div>
  </div>

</div> 
</div> 
</form>
</section>

@stop


@section('javascript')
<script type="text/javascript" src='{{asset("js/Plugins/ckeditor/ckeditor.js")}}'></script>
<script type="text/javascript" src='{{asset("js/Plugins/iCheck/icheck.js")}}'></script>
<script src="{{asset('js/Plugins/bootstraps/bootstrapValidator.js')}}"></script>
<script type="text/javascript" src='{{asset("js/property/edit.js")}}'></script>
<script type="text/javascript">
CKEDITOR.editorConfig = function( config ) {
  config.language = 'es';
  config.uiColor = '#F7B42C';
  config.height = 300;
  config.toolbarCanCollapse = true;
};  
CKEDITOR.replace("decription");

  $(".sidebar-menu").find("li").removeClass("active");
  $(".menu-property").addClass('active').find("ul").addClass("active menu-open").css("display","block").find('li:nth-child(2) a').css('color','#fff');
</script>
@stop
