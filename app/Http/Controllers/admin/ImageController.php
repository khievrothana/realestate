<?php 
namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use App\Images;
use Intervention\Image\ImageManagerStatic as Image;
use File;

class ImageController extends Controller
{

	public function index()
	{
		return View('admin.image.image');
	}

	public function upload(){
		$files  = Input::file('file');

		try{ 
			if($files) {
				$destinationPath = public_path() . '/uploads/';
				$filename = $files->getClientOriginalName();
				$physicalPath = date('YmdHis').$filename;
				$thumbnailPath = "300x".date('YmdHis').$filename;
				$upload_success = $files->move($destinationPath, $physicalPath);

				if($upload_success){ 
					$img = Image::make($destinationPath.$physicalPath);
					$img->fit(300);
					$img->save('uploads/'.$thumbnailPath);

					$img150 = Image::make($destinationPath.$physicalPath);
					$img150->fit(170);
					$img150->save('uploads/150x'.$physicalPath);

					$image = new Images();
					$image->Name = $filename;
					$image->PhysicalPath = $physicalPath;
					$image->ThumbnailPath = $thumbnailPath;
					$image->save();

					return $image;
				}
			}
		}catch(Exception $e){
				return 'Message: ' .$e->getMessage();
			}
	}

	public function GetList(){
		$image = new Images();
		$search = [];
		if(Input::has('SearchOption')){
			$search = Input::get('SearchOption');
		}
		$images = $image->skip($search['PageNumer'] * $search['DisplayNumber'])->take($search['DisplayNumber'])->orderBy('Id', 'desc')->get();
		$arr =  array('Data' =>array(
			'Images' => $images,
			'Total' =>$image->count()
			));
		return $arr ;
	}

	public function Delete(){
		if(Input::has('ImageIds')){
			$imageIds = Input::get('ImageIds');
			foreach ($imageIds as $imageId ) {
				$img = new Images();
				$image=$img->where('Id',$imageId)->first();
				if($image){
					$destinationPath = public_path() . '/uploads/';
					File::delete($destinationPath.$image->PhysicalPath);
					File::delete($destinationPath.'300x'.$image->PhysicalPath);
					File::delete($destinationPath.'150x'.$image->PhysicalPath);
					$img->where('Id',$imageId)->delete();
				}
			}
		}
	}

}