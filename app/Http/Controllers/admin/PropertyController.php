<?php 
namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Property;
use App\SearchOption;
use App\User;
use App\PropertyType;
use Input;
use App\Location\Province;
use App\PropertyFeature;
use App\PropertyImage;
use App\PropertyLocation;
use App\Feature;
use App\Images;
use DB;

class PropertyController extends Controller
{
 
    public function index(){

        return View('admin.property.property');
    }

    public function GetList(){

    	$property = new Property();
    	if(Input::has('SearchOption')){
    	$search = Input::get('SearchOption');
    	
        if($search['StatusType']==1){
            $property = $property->where('OnSale','=',1);
        }else if($search['StatusType']==2){
            $property = $property->where('OnRent',"=",1);
        } 
        if($search['Type']!=0){
            $property = $property->where("Type","=",$search['Type']);
        }
        $property = $property->where("Code","LIKE", "%".$search['SearchWord']."%");

        $propertyall = $property->get()->count();
    	$propertys = $property->skip($search['PageNumer'] * $search['DisplayNumber'])->take($search['DisplayNumber'])->orderBy('Id', 'desc')->get();
     	foreach ($propertys as $value) {
     		$value->User;
     		$value->PropertyType;
     	}
     	$arr =  array('Data' =>array(
     			'Properties' => $propertys,
     			'Total' =>$propertyall
     			));
    	return $arr ;
     }
    }

    public function GetBoundList(){

        $province = new Province();
        $provinces = $province->get();

        $propertyType = new PropertyType();
        $propertyTypes = $propertyType->get();

        $feature = new Feature();
        $features = $feature->get();

        $arr =  array('Data' =>array(
                'Provinces' => $provinces,
                'PropertyTypes' =>$propertyTypes,
                'PropertyFeatures'=>  $features
                ));
        return $arr ;
    }

    public function Save(){       
        DB::transaction(function(){
        
            $properties = Input::get('property');
            $property = new Property();
            foreach ($properties as $key => $value) {
               if($key!="Id"){
                 $property->$key = $value;
               }
            }
            $property->save();

            $imageIds = Input::get('ImageIds');
            if($imageIds!=null){
                foreach ($imageIds as $value) {
                            $propertyImage = new PropertyImage();
                            $propertyImage->ImageId = $value;
                            $propertyImage->PropertyId = $property->Id;
                            $propertyImage->save();
                        }
            }

            $locations = Input::get('location');

            if($locations!=null){
                $location = new PropertyLocation();
                 $location->PropertyId = $property->Id;
                foreach ($locations as $key => $value) {
                   if($value!=null){
                    $location->$key = (int)$value;
                   }
                }
                $location->save();
            }

            $features = Input::get('features');
            if($features!=null){
                foreach ($features as  $value) {
                      $feature = new PropertyFeature();
                      $feature->PropertyId = $property->Id;
                      $feature->FeatureId = (int)$value;
                      $feature->save();
                    }
            }

            return $arrayName = array('PropertyId' =>$property->Id);

        });
        
    }

    public function Update(){
        
        $properties = Input::get('property');
        $property = Property::find($properties['Id']);
        foreach ($properties as $key => $value) {
           $property->$key = $value;
        }
        $property->save();


        PropertyImage::where('PropertyId','=',$property->Id)->delete();
        $imageIds = Input::get('ImageIds');
        if($imageIds!=null){
            foreach ($imageIds as $value) {
                        $propertyImage = new PropertyImage();
                        $propertyImage->ImageId = $value;
                        $propertyImage->PropertyId = $property->Id;
                        $propertyImage->save();
                    }
        }
       
        $locations = Input::get('location');
        $location = PropertyLocation::where('PropertyId','=',$property->Id)->first();
        if($locations!=null){
          if($location==null){
            $location = new PropertyLocation();
          }
           $location->PropertyId = $property->Id;
            foreach ($locations as $key => $value) {
               if($value==null){
                $location->$key = null;
               }else{
                $location->$key = (int)$value;
               }
            }
            $location->save();
        }

        $features = Input::get('features');
        PropertyFeature::where('PropertyId','=',$property->Id)->delete();
        if($features!=null){
            foreach ($features as  $value) {
                  $feature = new PropertyFeature();
                  $feature->PropertyId = $property->Id;
                  $feature->FeatureId = (int)$value;
                  $feature->save();
                }
        }
        
       // return response()->json(array('msg' => 'Correct!' ), 400);
        return $arrayName = array('PropertyId' =>$property->Id);
        
    }

    public function Delete(){

        if(Input::has('Ids')){
            $ids = Input::get('Ids');
            foreach ($ids as $id) {
                $property = new Property();
                $property->where('Id', $id)->delete();
            }

            return $ids;
        }
    }

    public function Detail(){
        $id = Input::get('id');
        if(isset($id)){
            $property = new Property();
            $property = $property->where('Id',$id)->first();

            $imageIds = PropertyImage::where('PropertyId','=',$id)->select('ImageId')->get();
            $images = Images::whereIn('Id',$imageIds)->orderBy('Id','desc')->get();

            $featureIds =  PropertyFeature::where('PropertyId','=',$id)->select('FeatureId')->get();

            $location = PropertyLocation::where('PropertyId','=',$id)->first();

            $arr =  array('Data' =>array(
                            'Property' => $property,
                            'Images' => $images,
                            'Features' => $featureIds,
                            'Location' => $location
                ));
            return $arr;
        }
    }
    
    public function GetPropertyType(){

        $propertyTypes = PropertyType::get();

        return response()->json($propertyTypes); 
    }

    public function SavePropertyType(){

           $Type = Input::get("Type");
           $insertGetId = DB::table("propertytype")->insertGetId(array(
                'Name' => $Type["Name"],
                'Slug' => $Type["Slug"],
                'Description' => $Type["Description"],
                'DateCreated' => date('Y-m-d H:i:s')
                ));
           return $insertGetId;
        
    }

    public function UpdatePropertyType(){
          $Type = Input::get("Type");
          if($Type['Id'] !=null){
            DB::table("propertytype")->where('Id','=',$Type['Id'])->update(array(
                'Name' => $Type["Name"],
                'Slug' => $Type["Slug"],
                'Description' => $Type["Description"],
                'LastUpdated' => date('Y-m-d H:i:s')
                ));
            return $Type['Id'];
          } 
    }

    public function DeletePropertyType(){
        $id = Input::get("Id");
        DB::table("propertytype")->where('Id','=', $id)->delete();
        return $id;
    }
}
