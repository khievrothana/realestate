    @extends('layout.master')

    @section('css')
    <link href="{{asset('css/iCheck/iCheck.css')}}" rel="stylesheet" />
    <link href="{{asset('css/lightbox/lightbox.css')}}" rel="stylesheet" />
    @stop

    @section('content')

    <section class="content-header">
        <h1>
            Images
            <small>List</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Images</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="row">
                <div class="col-sm-12">
                    <div class="box-header">
                        <h3 class="box-title"><i class="fa fa-cubes"></i> Image Managerment</h3>
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
                    <div class="col-sm-12">
                        <button class="btn btn-primary btn-sm modalwindow" data-url="image/upload" data-evt="EditProduct" data-name="Register Product"><i class="fa fa-upload"></i> Upload New Images</button>
                        <button class="btn btn-primary btn-sm  delete" > <i class="fa fa-trash"></i> Delete Images </button>
                        <label><input type="checkbox" class="allCheck"> Select All </label>
                        <div class="btn-group" style="float:right; margin:10px 5px;">
                            <button type="button" class="btn btn-primary btn-sm displayNumberText">Display Number</button>
                            <button type="button" class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown"> <span class="caret"></span> <span class="sr-only">Toggle Dropdown</span> </button>
                            <ul class="dropdown-menu displayNumber" role="menu">
                                <li><a href="#" rel="20">20 Showing</a></li>
                                <li><a href="#" rel="30">30 Showing</a></li>
                                <li><a href="#" rel="50">50 Showing</a></li>
                                <li><a href="#" rel="100">100 Showing</a></li>
                            </ul>
                        </div>

                        <div class="imageBox imageList" id="list">


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @stop

    @section('javascript')
    <script type="text/javascript" src='{{asset("js/Plugins/iCheck/icheck.js")}}'></script>
    <script type="text/javascript" src='{{asset("js/Plugins/lightbox/lightbox.js")}}'></script>
    

    <script type="text/javascript">

    var searchOption= {
        PageNumer : 0,
        DisplayNumber :21
    }
    var Resource = {

    }

    $("body").on("click", ".modalwindow", function () {
        Resource.url = $(this).attr("data-url"),
        Resource.title = $(this).attr("data-name"),
        Resource.evt = $(this).attr("data-evt")
        _openIframe(_initFrame, Resource);
        return false;
    });
    var _initFrame = function(param) {

        console.log(param.data);

    }

    ListImage();

    $("body").on("click", ".pagination a", function () {
        currentPage = Number($(this).attr('data-pagination'));
        if (currentPage > 0) {
            searchOption.PageNumer = currentPage - 1;
            ListImage();
        }
        return false;
    });

    $("body").on("click", ".displayNumber a", function (e) {
        e.preventDefault();
        searchOption.DisplayNumber = $(this).attr("rel");
        searchOption.PageNumer=0;
        ListImage();
        $(".displayNumberText").text($(this).text());
    });

    $("body").on("ifChanged", ".allCheck", function (e) {
        if($(this).prop('checked')){ 
            $(".imageList").find('.icheckbox_minimal').addClass("checked").find(":checkbox").prop('checked',true);
        }else{
            $(".imageList").find('.icheckbox_minimal').removeClass("checked").find(":checkbox").prop('checked',false);
        }
    });

    $("body").on("click", ".delete", function (e) {
       var checkboxs = $('.imageList').find(":checkbox:checked");
       if(checkboxs.length > 0){
        console.log(checkboxs.length);
         var imageIds = new Array();
               $.each(checkboxs, function(index, item){
                var id = $(this).closest('dl').attr('data-id');
                imageIds.push(id);
                });

               $.ajax({
                type : "GET",
                url : "image/Delete",
                data: { ImageIds : imageIds}
            }).done(function(data){
                swal("Delete !", "You has Delete the Images !", "success")
                $.each(checkboxs, function(index, item){
                    $(this).closest('dl').fadeOut();
                });
            });
        
         }else{
                swal('Please Checked Images','','warning');
            }
        checkboxs.length=0;
    });

    function ListImage(){
        GetImages(function(data){
            console.log(data);
            TableImage(data.Images,function(data){
                $(".imageList").html(data).iCheck({ checkboxClass: 'icheckbox_minimal' });
            });
            Pagination(searchOption.PageNumer, data.Total);
        });
    }

    function GetImages(callback){
        $.ajax({
            type : "GET",
            url : "image/GetList",
            data: { SearchOption : searchOption}
        }).done(function(data){
            if(typeof callback=='function'){
                callback(data.Data);
            }
        });
    }

    function TableImage(Images,callback){
        if(typeof Images !=undefined && Images !=null){
            var result = '';
            $.each(Images, function(index, image){
                result += '<dl data-id='+image.Id+'>';
                result += '<dt><a href="{{asset("uploads")}}/'+image.PhysicalPath+'" rel="lightbox"><img src="{{asset("uploads")}}/150x'+image.PhysicalPath+'" ></a></dt>';
                result += '<dd>';    
                result += '<label> <input type="checkbox" name="check" /> </label>';    
                result += ' </dd>';  
                result += '</dl>';  
            });
        }
        if(typeof callback ==='function'){
            callback(result);
        }
    }

    function Pagination(npage, allImages) {
        var currentPage = npage + 1;
        var totalPage = Math.ceil(allImages / Number(searchOption.DisplayNumber));
        var pagination = (currentPage) + "Page〜" + totalPage + "Pages (All " + allImages + " Images)";
        $("body").find(".pagination span").show().text(pagination);
        var pre = currentPage - 1;
        var next = currentPage + 1;
        $("body").find(".pagination a#p1").attr('data-pagination', pre).closest('li').show();
        $("body").find(".pagination a#p2").text(pre).attr('data-pagination', pre).closest('li').show();
        $("body").find(".pagination a#p3").text(currentPage).attr('data-pagination', currentPage).closest('li').show();
        $("body").find(".pagination a#p4").text(next).attr('data-pagination', next).closest('li').show();
        $("body").find(".pagination a#p5").attr('data-pagination', next).closest('li').show();
        $("body").find('.pagination a').each(function () {
            if ($(this).attr('data-pagination') <= 0 || $(this).attr('data-pagination') > totalPage) {
                $(this).closest('li').hide();
            }
        });
    }


    </script>
    <script type="text/javascript">
        $(".sidebar-menu").find("li").removeClass("active");
        $(".menu-image").addClass('active');
    </script>
    @stop