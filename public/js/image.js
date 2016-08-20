$(function(){

	var searchOption= {
		PageNumer : 0,
		DisplayNumber :20
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

	function ListImage(){
		GetImages(function(data){
			console.log(data);
			TableImage(data.Images,function(data){
				$(".imageList").append(data);
			})
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
					result += '<dl>';
					result += '<dt><a href="'+image.PhysicalPath+'" rel="lightbox"><img src="'+image.PhysicalPath+'" ></a></dt>';
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


});