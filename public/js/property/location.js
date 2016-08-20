$(function(){

    var option = {
        url : "/RealManagerment/public/administrator/property/location/addnew",
    }

    GetListProvince();

    function TableLocation(Types, callback){
    	var result = '';
    	if(typeof Types !=undefined && Types !=null){
    		$.each(Types, function(index, type){
    			result +='<tr data-id='+type.Id+'>';
                result +=' <td>'+type.Name+'</td>';
                result +='<td> '+type.Description+'</td>';
                result +='<td><button class="btn btn-danger btn-xs delete"> <i class="fa fa-trash-o"></i> Delete</button> <button class="btn btn-primary btn-xs edit"> <i class="fa fa-pencil-square-o"></i> Edit</button> </td>';
                result +='</tr>';
    		});
    	}
    	if(typeof callback=='function'){
    		callback(result);
    	}
    }

    function GetListProvince(){
    	 GetListLocation(0,function(data){
    			$("#select-location").attr("disabled","disabled");
    			TableLocation(data.Province,function(data){
    				$(".table-location").find("tr:not(:first)").remove();
    				$(".table-location").append(data);
    			});
    	});
    }


    function GetListLocation(url, callback){
    	var action = [
    	 	"/RealManagerment/public/location/GetListDistrict",
    	 	"/RealManagerment/public//location/GetListDistrict",
    	 	"/RealManagerment/public//location/GetListCommune",
    	 	"/RealManagerment/public//location/GetListVillage"
    	 ];
    	$.ajax({
    		type: "GET",
    		url : action[url]
    	}).done(function(data){
    		 if(typeof callback =='function'){
    		 	callback(data);
    		 }
    	});
    }
  

    function AddValidation(option){

     var form = $("#mainForm");

      form.bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
               fields: {
                    name : {
                        trigger: 'blur',
                        validators: {
                            notEmpty: {}
                        }
                    }  
            }
    }).on('success.form.bv', function (e) {
        e.preventDefault();
        SaveUpdate(option);
    });

    $("body").on("click", ".save", function (e) {
        form.bootstrapValidator('validate');
        e.preventDefault();
    });

    }

    $("body").on("click", ".clear", function(e){
        e.preventDefault();
         $("#mainForm").removeAttr("data-id");
         $("[name=name]").val('');
         $("[name=slug]").val('');
         $("[name=description]").val('');
         option.url = "/RealManagerment/public/administrator/property/location/addnew";
    });

    $("body").on("click", ".delete", function(e){
        e.preventDefault();
        var id = $(this).closest("tr").attr("data-id");
        var select = $(this).closest("tr");
        swal({
            title: "Delete",
            text: "Do you want to delete ?",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "OK",
            cancelButtonText: "Cancel",
            closeOnConfirm: false
        }, function () {
            $.ajax({
                type: "GET",
                url: '/RealManagerment/public/administrator/property/type/Delete',
                dataType: "JSON",
                data: ({ Id : id })
            }).done(function (data) {
                swal("Property have been Deleted ", "", "success");
                $(select).fadeOut();
            });
        });
    });

    $("body").on("click", ".edit", function(e){
        e.preventDefault();
        var tr = $(this).closest('tr');
        var name = $(tr).find('td:nth-child(1)').text();
        var slug =  $(tr).find('td:nth-child(2)').text();
        var description = $(tr).find('td:nth-child(3)').text();
         $("#mainForm").attr("data-id", $(tr).attr('data-id'));
         $("[name=name]").val(name);
         $("[name=slug]").val(slug);
         $("[name=description]").val(description);
         option.url = "/RealManagerment/public/administrator/property/type/update";
    });

    $("body").on("ifChecked", "#location", function(e){
    	 var value = $(this).val();	 
    	 GetListLocation(value, function(data){
    	 	 if(value == 1){
    	 	 	$("#select-location").removeAttr('disabled');
    	 	 	HTMLSelectList(data.Province, function(data){
    	 	 		$("#select-location").html(data);
    	 	 	});
    	 	 	TableLocation(data.District, function(data){
    	 	 		$(".table-location").find("tr:not(:first)").remove();
    				$(".table-location").append(data);
    	 	 	});
    	 	 }else if(value==2){
    	 	 	$("#select-location").removeAttr('disabled');
    	 	 	HTMLSelectList(data.District, function(data){
    	 	 		$("#select-location").html(data);
    	 	 	});
    	 	 	TableLocation(data.Commune, function(data){
    	 	 		$(".table-location").find("tr:not(:first)").remove();
    				$(".table-location").append(data);
    	 	 	});
    	 	 }else if(value==3){
    	 	 	$("#select-location").prop('disabled', true);
    	 	 	TableLocation(data.Village, function(data){
    	 	 		$(".table-location").find("tr:not(:first)").remove();
    				$(".table-location").append(data);
    	 	 	});
    	 	 }else if(value==0){
    	 	 	$("#select-location").prop('disabled', true);
    	 	 	TableLocation(data.Province, function(data){
    	 	 		$(".table-location").find("tr:not(:first)").remove();
    				$(".table-location").append(data);
    	 	 	});
    	 	 }
    	 });

    });

     $("body").on("change","#select-location", function(){
        var id = $(this).val();
        var type = $("#location:checked").val();
        var action=[
        	"",
        	"/RealManagerment/public/location/GetDistrictByProvinceId",
        	"/RealManagerment/public/location/GetCommuneByDistrictId",
        	"/RealManagerment/public/location/GetVillageByCommuneId"
        ]
        $.ajax({
            type : "GET",
            url : action[type],
            data : ({id : id})
            }).done(function(data){
             console.log(data);
        });
    });

    function SaveUpdate(option){
        var Type = {
            Id : $("#mainForm").attr("data-id"),
            Name : $("[name=name]").val(),
            Slug : $("[name=slug]").val(),
            Description : $("[name=description]").val()
        }
        var _token = $('[name=_token]').val();

        $.ajax({
            type : "POST",
            url : option.url,
            data : ({Type : Type, _token : _token})
        }).done(function(data){
                ListPropertyType();
                option.url = "/RealManagerment/public/administrator/property/type/update";
                $("#mainForm").attr("data-id", data);
                swal("Property Type has been Save !","","success");
        });
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

});