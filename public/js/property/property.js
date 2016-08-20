$(document).ready(function(e){
	var searchOption= {
		PageNumer : 0,
		DisplayNumber : 10,
		StatusType : 0,
		SearchWord : '',
		Type : 0
	}
	var Resource = {

	}
	ListProperty();
	GetBoundList(function(data){
		var Types = data.PropertyTypes;
		HTMLSelectList(Types, function(data){
			$("#Type").append(data);
		});
	});

	$("body").on("click", ".modalwindow", function () {
		Resource.url = $(this).attr("data-url"),
		Resource.title = $(this).attr("data-name"),
		Resource.evt = $(this).attr("data-evt")
		_openIframe(_initFrame, Resource);
		return false;
	});

	  $("body").on("click", ".pagination a", function () {
        currentPage = Number($(this).attr('data-pagination'));
        searchOption.Type = $("#Type option:selected").val();
        searchOption.SearchWord = $("#searchWord").val();
        if (currentPage > 0) {
            searchOption.PageNumer = currentPage - 1;
            ListProperty();
        }
        return false;
    });

    $("body").on("click", ".displayNumber a", function (e) {
        e.preventDefault();
        searchOption.DisplayNumber = $(this).attr("rel");
        searchOption.PageNumer=0;
        ListProperty();
        $(".displayNumberText").text($(this).text());
    });

    $("body").on("click", ".searchButton", function (e) {
        e.preventDefault();
        searchOption.Type = $("#Type option:selected").val();
        searchOption.SearchWord = $("#searchWord").val();
        searchOption.StatusType = $(":radio:checked").val();
        ListProperty();
    });
    

       $("body").on("ifChanged", ".allChecked", function (e) {
        if($(this).prop('checked')){ 
            $(".table").find('.icheckbox_minimal').addClass("checked").find(":checkbox").prop('checked',true);
        }else{
            $(".table").find('.icheckbox_minimal').removeClass("checked").find(":checkbox").prop('checked',false);
        }
    });

       $("body").on("click", ".delete", function () {
        
        var checkboxs = $('.table').find(':checkbox:checked');
		var select = $(checkboxs).closest('tr');
		var Ids = new Array();
        $.each(checkboxs, function(index){
        	Ids.push($(this).closest('tr').attr('data-id'));
        });
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
                url: 'property/Delete',
                data: ({ Ids : Ids })
            }).done(function (data) {
            	console.log(data);
                swal("Property have been Deleted ", "", "success");
                $(select).remove();
            });
        });
    });

	var _initFrame = function(param) {

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
						result += '<div class="col-xs-3 col-md-3">';
						result += '<a href="#" class="thumbnail" data-id='+id+'>';
						result += ' <img src="'+imagePath+'" alt="...">';
						result += '</a>';
						result += '</div>';
					})
					$('.property-images').find('.row').append(result);
					$(".modals").fadeOut("fast", function () { $(this).remove(); });
				}
			});
		}

	}

	function ListProperty(){
		GetProperty(function(data){
			TableProduct(data.Properties, function(data){
				$('.table').find('tr:not(:first)').remove();
				$('.table').append(data).find(':checkbox').iCheck({ checkboxClass: 'icheckbox_minimal' });
			});

			Pagination(searchOption.PageNumer, data.Total);
		})
	}

	function GetProperty(callback){
		$.ajax({
			type : 'GET',
			url : 'property/GetList',
			data: { SearchOption : searchOption},
		}).done(function(data){
			console.log(data);
			if(typeof callback == 'function'){
				callback(data.Data);
			}
		});
	}

	function TableProduct(Properties, callback){
		if(typeof Properties !=undefined){
			var result = '';
			$.each(Properties, function(index, item){
				result += '<tr data-id='+item.Id+'>';
				result +='<td><a href="property/edit/'+item.Id+'"><button type="button" class="btn btn-danger btn-xs">';
                result +='<i class="fa fa-pencil-square-o"></i> Edit </button></a>';
                result +='</td>';
                result +='<td style="text-align:center"><label>';
                result +='<input type="checkbox">'          
                result +='</label></td>';            
                result +='<td><a href="#"><img src="http://localhost/RealManagerment/public/uploads/'+item.Thumbnail+'" style="width: 72px; height: 72px;"></a></td>';         
                result +='<td style="text-align: left;">'+item.Code+'</td>';
                result +='<td style="text-align:left;">'+item.Name+'</td>';
                result +='<td style="text-align: right;"> '+item.property_type.Name+'</td>';
                result +='<td>$'+item.Price+'</td>';
                result +='<td>';
                var status = '';
                 if(item.OnSale==1){
                 	status = '<p>On Sale<p>';
                 }
                 if(item.OnRent==1){
                 	status += '<p>On Rent<p>';
                 }
                result += status+'</td>';
                result +='<td>25 X 12(M)</td>';
                result +='<td> <p>Phnom Penh</p> </td>';
                result +='<td><p >'+item.DateCreated+'</p></td>';
                result +='<td><button class="btn btn-primary btn-xs"> <i class="fa fa-search-plus"></i> Preview</button></td>';
                result +='</tr>';
			});
		}
		if(typeof callback == 'function'){
			callback(result);
		}
	}

	function GetBoundList(callback){
         $.ajax({
            type : "GET",
            url : "property/GetBoundList"
        }).done(function(data){
            console.log(data);
            if(typeof callback=='function'){
                callback(data.Data);
            }
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

}); 