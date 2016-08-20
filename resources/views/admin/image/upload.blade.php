<html>
<head>
    <meta charset="UTF-8">
    <title>Product Managerment</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport' />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link href="{{asset('css/bootstrap/bootstrap.min.css')}}" rel="stylesheet" />
    <link href="{{asset('css/dropzone/dropzone.css')}}" rel="stylesheet" /> 
    <link href="{{asset('css/iCheck/iCheck.css')}}" rel="stylesheet" /> 
    <link href="{{asset('css/basic.css')}}" rel="stylesheet" />
    <link href="{{asset('css/lightbox/lightbox.css')}}" rel="stylesheet" />
     <link href="{{asset('css/sweetAlert/sweetalert.css')}}" rel="stylesheet" />
    <style type="text/css">
        .box{
            padding: 10px;
        }
        #Upload{
            overflow: scroll;
        }
    </style> 

</head>
<body style="margin:10px 5px;">
    <section class="content" style="overflow: hidden; max-height: 535px;">
        <div class="box imageUpload">
                <ul class="nav nav-tabs">
                    <li class="nav "><a href="#Upload" data-toggle="tab"><i class="fa fa-upload"></i>Upload Images</a></li>
                    <li class="nav active"><a href="#ImageLIst" data-toggle="tab" class="listImage">Images List</a></li>
                    <div class="imageAction">
                        <button class="btn btn-primary btn-sm delete"> <i class="fa fa-trash"></i> Delete Images </button>
                        <button class="btn btn-primary btn-sm select"> <i class="fa fa-plus"></i> Select Images </button>
                        
                    </div>
                    
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane fade " id="Upload">
                        <div id="dropzone">
                            <form action="{{ url('image/upload')}}" class="dropzone"  style="border:none; min-height:350px;" method="POST">
                               <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="fallback">
                                    <input name="file" type="file" multiple />
                                    <h1> Drap Drop Here </h1>
                                </div>
                            </form>
                        </div>
                   </div>
                    <div class="tab-pane fade in active " id="ImageLIst">
                        <div class="imageBox imageList" id="list">
                            
                        </div>
                    </div>
                </div>
        </div>
    </section>
    <script type="text/javascript" src="{{asset('js/Plugins/jquery-1.11.3.min.js')}}"></script>
    <script type="text/javascript" src='{{asset("js/Plugins/iCheck/icheck.js")}}'></script>
    <script type="text/javascript" src="{{asset('js/Plugins/bootstraps/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/Plugins/dropzone/dropzone.js')}}"></script>
    <script type="text/javascript" src='{{asset("js/Plugins/lightbox/lightbox.js")}}'></script>
    <script type="text/javascript" src='{{asset("js/Plugins/sweetalert/sweetalert.min.js")}}'></script>
    <script type="text/javascript">
    $('input[type=checkbox]').iCheck({ checkboxClass: 'icheckbox_minimal' });
       Dropzone.autoDiscover = false;
       var myDropzone = new Dropzone(".dropzone");
        myDropzone.on("success", function(file, image) {
                console.log(image);
             
                   var result = '<dl data-id='+image.Id+'>';
                        result += '<dt><a href="{{asset("uploads")}}/'+image.PhysicalPath+'" rel="lightbox"><img src="{{asset("uploads")}}/300x'+image.PhysicalPath+'" ></a></dt>';
                        result += '<dd>';    
                        result += '<label> <input type="checkbox" name="check" /> </label>';    
                        result += ' </dd>';  
                        result += '</dl>';  

                $(document).find(".imageList").prepend(result).iCheck({ checkboxClass: 'icheckbox_minimal' });;

         });

        var searchOption= {
                PageNumer : 0,
                DisplayNumber :32
            }

        $(".imageList").on('scroll',function(){
            if($(this).scrollTop() + $(this).innerHeight()>=$(this)[0].scrollHeight-2){
              searchOption.PageNumer+=1;
              ListImage();
            }
        });

        $("body").on("click", ".delete", function (e) {
           var checkboxs = $('.imageList').find(":checkbox:checked");
           if(checkboxs.length ==0){
                 swal('Please Checked Images','','warning');
           }else{
                var imageIds = new Array();
               $.each(checkboxs, function(index, item){
                var id = $(this).closest('dl').attr('data-id');
                imageIds.push(id);
                });

               $.ajax({
                type : "GET",
                url : "{{url('image/Delete')}}",
                data: { ImageIds : imageIds}
            }).done(function(data){
                swal("Delete !", "You has Delete the Images !", "success")
                $.each(checkboxs, function(index, item){
                    $(this).closest('dl').fadeOut();
                });
            });
           }
        });

        $("body").on("click", ".select", function (e) {
           var checkbox = $('.imageList').find(":checkbox:checked");
           if(checkbox.length ==0){
                 swal('Please Checked Images','','warning');
           }else{
               
           }
        });        

        //function list Image    
        ListImage();

        function ListImage(){
        GetImages(function(data){
            TableImage(data.Images,function(data){
                $(".imageList").append(data).iCheck({ checkboxClass: 'icheckbox_minimal' });
                });
            });
        }

        function GetImages(callback){
            $.ajax({
                type : "GET",
                url : "{{ url('image/GetList')}}",
               data: { SearchOption : searchOption}
            }).done(function(data){
                if(typeof callback ==='function'){
                    callback(data.Data);
                }
            })
        }

       function TableImage(Images,callback){
            if(typeof Images !=undefined && Images !=null){
                var result = '';
                $.each(Images, function(index, image){
                        result += '<dl data-id='+image.Id+'>';
                        result += '<dt><a href="{{asset("uploads")}}/'+image.PhysicalPath+'" rel="lightbox"><img src="{{asset("uploads")}}/300x'+image.PhysicalPath+'" ></a></dt>';
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

    </script>
</body>
</html>

