$(function(){

    BoundList();
    var option={
        action : ""
    }

    var id =$(location).attr('href').split('/').pop().replace('#','');

    if($.isNumeric(id)){
        ListDetail();
        option.action = "/RealManagerment/public/administrator/property/Update";
    }else{
        option.action = "/RealManagerment/public/administrator/property/Save";
        $(".addnew,.preview,.delete").prop('disabled',true);
    }

    $("body").on("click", ".modalwindow", function () {
        option.url = $(this).attr("data-url"),
        option.title = $(this).attr("data-name"),
        option.evt = $(this).attr("data-evt")
        _openIframe(_initFrame, option);
        return false;
    });

    var _initFrame = function(param){

        var contents = $(this).contents();

        if(param.data.evt=="feature"){
            $(contents).on('click','.select',function(){
                var dl = $(contents).find('.imageList').find(':checkbox:checked').closest('dl');
                if(dl.length >0){   
                    var id = $(dl).attr('data-id');
                    var imagePath = $(dl).find('img').attr('src');
                    $('body').find('.thumbnail').find('.feature').attr('src',imagePath);
                    $(".modals").fadeOut("fast", function () { $(this).remove(); });
                }
            });
        }
        if(param.data.evt=="slider"){
            $(contents).on('click','.select',function(){
                var dls = $(contents).find('.imageList').find(':checkbox:checked').closest('dl');
                if(dls.length >0){  
                    var result = '';
                    $.each(dls, function(index, dl){
                        var id = $(dl).attr('data-id');
                        var imagePath = $(dl).find('img').attr('src');     
                        result += '<div class="col-xs-3 col-md-3 img">';
                        result += '<a href="#" class="thumbnail" data-id='+id+'>';
                        result += '<div class="delImage"><i class="fa fa-trash-o"></i></div>';
                        result += ' <img src="'+imagePath+'" alt="...">';
                        result += '</a>';
                        result += '</div>';
                    })
                    $('.property-images').find('.slider').append(result);
                    $(".modals").fadeOut("fast", function () { $(this).remove(); });
                }
            });
        }
    }

    AddValidationProperty(option);

    function BoundList(){
        GetBoundList(function(data){
            var PropertyTypes = data.PropertyTypes;
            HTMLSelectList(PropertyTypes, function(data){
                $("#propertyType").find("option:not(:first)").remove();
                $("#propertyType").append(data);
            });

            var Provinces = data.Provinces;
            HTMLSelectList(Provinces, function(data){
                $("#province").append(data);
            });

            var Features = data.PropertyFeatures;
            PropertyFeature(Features, function(data){
                $(".property-feature").html(data).find(":checkbox").iCheck({ checkboxClass: 'icheckbox_minimal' });
            });
        });
    }

    function ListDetail(){
        GetDetail(function(data){
            TableDetail(data.Property);
            TableImageDetail(data.Images);
            TableFeatureDeatil(data.Features);
            TableLocationDetail(data.Location);
        })
    }

    function GetBoundList(callback){
         $.ajax({
            type : "GET",
            url : "/RealManagerment/public/administrator/property/GetBoundList"
        }).done(function(data){
            console.log(data);
            if(typeof callback=='function'){
                callback(data.Data);
            }
        });
    }

    function GetDetail(callback){
        $.ajax({
            type : "GET",
            url : "/RealManagerment/public/administrator/property/Detail",
            data : ({id : id})
        }).done(function(data){
            console.log(data);
            if(typeof callback=='function'){
                callback(data.Data);
            }
        });
    }

    function TableDetail(Property){
        if(typeof Property !=undefined && Property !=null){
          $('.table').attr('data-id', Property.Id);
          $('.thumbnail').find('.feature').attr('src','/RealManagerment/public/uploads/'+Property.Thumbnail);
          $('[name=code]').val(Property.Code);
          $('[name=name]').val(Property.Name);
          $('[name=price]').val(Property.Price);
          if(Property.OnSale==1){
            $('#onsale').prop('checked', true).closest('.icheckbox_minimal').addClass('checked');
          }
          if(Property.OnRent==1){
            $('#onrent').prop('checked', true).closest('.icheckbox_minimal').addClass('checked');
          }          
          $("[name=proeprtySize]").val(Property.PropertySize);
          $('[name=landSize]').val(Property.LandSize);
          $('[name=bathRoom]').val(Property.BathRoom);
          $('[name=bedRoom]').val(Property.BedRoom);
          CKEDITOR.instances.decription.setData(Property.Description);
          $('#propertyType option[value='+Property.Type+']').prop('selected',true);
        }
    }

    function TableImageDetail(Images){
        if(typeof Images !=undefined && Images!=null){
            var result = '';
            $.each(Images, function(index, image){    
                result += '<div class="col-xs-3 col-md-3 img">';
                result += '<a href="#" class="thumbnail" data-id='+image.Id+'>';
                result += '<div class="delImage"><i class="fa fa-trash-o"></i></div>';
                result += ' <img src="/RealManagerment/public/uploads/'+image.ThumbnailPath+'" alt="'+image.Name+'">';
                result += '</a>';
                result += '</div>';
            });
            $('.property-images').find('.slider').append(result);
        }
    }

    function TableFeatureDeatil(Features){
        if(typeof Features !=undefined){
            $.each(Features, function(index, feature){
                $(":checkbox[value="+feature.FeatureId+"]").prop('checked',true).closest(".icheckbox_minimal").addClass('checked');
            });
        }
    }

    function TableLocationDetail(Location){
        if(typeof Location !=undefined && Location!=null){
            Province(Location.ProvinceId).complete(function(){
                $("#province").find('option[value='+Location.ProvinceId+']').prop('selected',true);
                if(Location.DistrictId!=null){
                    $("#district").find('option[value='+Location.DistrictId+']').prop('selected',true);
                    $("#district").removeAttr('disabled');
                }
                District(Location.DistrictId).complete(function(){
                    if(Location.CommuneId!=null){
                        $("#commune").removeAttr('disabled');
                        $("#commune").find('option[value='+Location.CommuneId+']').prop('selected',true);
                    }
                    Commune(Location.CommuneId).complete(function(){
                        if(Location.VillageId!=null){
                            $("#village").removeAttr('disabled');
                            $("#village").find('option[value='+Location.VillageId+']').prop('selected',true);
                        }
                    });
                });
            });            
        }
    }

    function HTMLSelectList(Types, callback){
        var result = "";
        if(typeof Types !=undefined && Types !=null){
            $.each(Types, function(index, type){
                result +='<option value='+ type.Id +'>'+ type.Name +'</option>';
            });
        }
        if(typeof callback=='function'){
            callback(result);
        }
    }

    function PropertyFeature(Features, callback){
        var result='';
        if(typeof Features !=undefined && Features!=null){
            $.each(Features, function(index, feature){
                result +='<label>';
                result +='<input type="checkbox" value='+ feature.Id +'> '+ feature.Name;
                result +='</label>';
            })
        }

        if(typeof callback=='function'){
            callback(result);
        }
    }

    function AddValidationProperty(option) {
      var form = $("#mainForm");
      form.bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
               fields: {
                    code : {
                        trigger: 'blur',
                        validators: {
                            notEmpty: {}
                        }
                    },
                    name : {
                        trigger: 'blur',
                        validators: {
                            notEmpty: {}
                        }
                    },
                    price: {
                        trigger: 'blur',
                        validators: {
                            notEmpty: {},
                            numeric: {
                                message: "Diplay Price only contain number"
                            }
                        }
                    },
                    bedRoom: {
                        trigger: 'blur',
                        validators: {
                            numeric: {
                                message: "Diplay Price only contain number"
                            }
                        }
                    },
                    bathRoom: {
                        trigger: 'blur',
                        validators: {
                            numeric: {
                                message: "Diplay Price only contain number"
                            }
                        }
                    },
            }
    }).on('success.form.bv', function (e) {
        e.preventDefault();
        SaveUpdateProperty(option);
    });

    $("body").on("click", ".save", function (e) {
        form.bootstrapValidator('validate');
        e.preventDefault();
    });

    }

    function SaveUpdateProperty(option){
       
        var thumbnailPath = $('.thumbnail').find('.feature').attr('src');
        thumbnailPath = thumbnailPath.split("uploads/").pop();
        var property ={
            Id : Number($('.table').attr('data-id')),
            Code : $('[name=code]').val(),
            Name : $('[name=name]').val(),
            Price : Number($('[name=price]').val()),
            OnSale : $('#onsale').is(':checked')==true ? 1 : 0,
            OnRent : $('#onrent').is(':checked')==true ? 1 : 0,
            Type : Number($("#propertyType option:selected").val()),
            PropertySize : $("[name=proeprtySize]").val(),
            LandSize : $('[name=landSize]').val(),
            BathRoom : Number($('[name=bathRoom]').val()),
            BedRoom : Number($('[name=bedRoom]').val()),
            Description : CKEDITOR.instances.decription.getData(),
            Thumbnail : thumbnailPath,

        } 

        var _token = $('[name=_token]').val();

        var Images = $('.slider').find('.img');
        var ImageIds = new Array();
        $.each(Images, function(index){
            ImageIds.push($(this).find('.thumbnail').attr('data-id'));
        });

        var location = {
            ProvinceId : $("#province option:selected").val(),
            DistrictId : $("#district option:selected").val(),
            CommuneId : $("#commune option:selected").val(),
            VillageId : $("#village option:selected").val(),
        } 

        var featureIds = new Array();
        var features = $('.property-feature').find(':checkbox:checked');
            $.each(features, function(index){
                featureIds.push($(this).val());
            });

        $.ajax({
            type : "POST",
            url : option.action,
            data : ({ property : property, ImageIds : ImageIds, location : location, features : featureIds, _token : _token })
        }).done(function(data){
            swal("Property has been Save.. !","","success");
            option.action = "/RealManagerment/public/administrator/property/Update";
            $(".table").attr('data-id', data.PropertyId);
            $(".save").removeAttr('disabled');
            $(".addnew,.preview,.delete").prop('disabled',false);

        }).error(function(data){
            swal("System Error ","","danger");
        });
    }

    $("body").on("click", ".delImage", function(e){
        e.preventDefault();
        $(this).closest('.img').fadeOut().remove();
    });

    $("body").on("click", ".addnew", function(e){
        e.preventDefault();
        Clear();
        $(".addnew,.preview,.delete").prop('disabled',true);
        option.action = "/RealManagerment/public/administrator/property/Save";
    });

    $("body").on("click", ".delete", function(e){
        e.preventDefault();
        var ids = new Array();
        ids.push(id);

        swal({
            title: "Delete",
            text: "Do you want to delete ?",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "OK",
            cancelButtonText: "Cancel",
            closeOnConfirm: false
        }, function () {
            console.log(ids);
            $.ajax({
                type: "GET",
                url: '/RealManagerment/public/administrator/property/Delete',
                dataType: "JSON",
                data: ({ Ids: ids })
            }).done(function (data) {
                swal("Property have been Deleted ", "", "success");
                $('.addnew').click();
            });
        });
    });

    $("body").on("change","#province", function(){
        var id = $(this).val();
        Province(id).complete(function(){
            $("#district").removeAttr('disabled');
             $("#commune,#village").prop("disabled",true).find("option:not(:first)").remove();
        });
    });
    $("body").on("change","#district", function(){
        var id = $(this).val();
        District(id).complete(function(){
            $("#commune").removeAttr('disabled');
            $("#village").prop("disabled",true).find("option:not(:first)").remove();
        });
    });
    $("body").on("change","#commune", function(){
        $("#village").removeAttr('disabled');
        var id = $(this).val();
        Commune(id);   
    });


    function Province(id){
      return  $.ajax({
            type : "GET",
            url : "/RealManagerment/public/location/GetDistrictByProvinceId",
            data : ({id : id})
            }).done(function(data){
             var Districts = data.Districts;
             if(typeof Districts !=undefined && Districts !=null){
                $("#district").find("option:not(:first)").remove();
                $.each(Districts, function(inde, district){
                    $("#district").append("<option value="+district.Id+">"+district.Name+"</option>");
                });
             }
        });
    }

    function District(id){    
        return $.ajax({
            type : "GET",
            url : "/RealManagerment/public/location/GetCommuneByDistrictId",
            data : ({id : id})
        }).done(function(data){
            var Communes = data.Communes;
             if(typeof Communes !=undefined && Communes !=null){
                $("#commune").find("option:not(:first)").remove();
                $.each(Communes, function(inde, commune){
                    $("#commune").append("<option value="+commune.Id+">"+commune.Name+"</option>");
                });
             }
        });
    }

    function Commune(id){
        return  $.ajax({
                    type : "GET",
                    url : "/RealManagerment/public/location/GetVillageByCommuneId",
                    data : ({id : id})
                }).done(function(data){
                    var Villages = data.Villages;
                     if(typeof Villages !=undefined && Villages !=null){
                        $("#village").find("option:not(:first)").remove();
                        $.each(Villages, function(inde, village){
                            $("#village").append("<option value="+village.Id+">"+village.Name+"</option>");
                        });
                     }
                });
        }
    
    function Clear(){
        $(":text").val("");
        $(":checkbox").prop("checked", true).closest(".icheckbox_minimal").removeClass("checked");
        $(".property-images").find(".img").remove();
        $("#province option:first").prop("selected",true).change();
        CKEDITOR.instances.decription.setData('');
    }


});