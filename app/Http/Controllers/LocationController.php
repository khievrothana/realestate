<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use App\Location\Province;
use App\Location\District;
use App\Location\Commune;
use App\Location\Village;

class LocationController extends Controller
{
     
     function GetDistrictByProvinceId(){
        $id = Input::get('id');

        $district = new District();
        if(isset($id)){
            $district = $district->where("ProvinceId",$id)->get();
        }
        $arr= array('Districts' =>$district);

        return $arr;
     }

     function GetCommuneByDistrictId(){
        $id = Input::get('id');

        $commune = new Commune();
        if(isset($id)){
            $commune = $commune->where("DistrictId",$id)->get();
        }
        $arr= array('Communes' =>$commune);

        return $arr;
     }

     function GetVillageByCommuneId(){
          
        $id = Input::get('id');
        $village = new Village();
        if(isset($id)){
            $village = $village->where("CommuneId",$id)->get();
        }
        $arr= array('Villages' =>$village);

        return $arr;
     }

     function ListProvince(){
        $arr= array('Province' =>Province::get());
        return $arr;
     }

     function ListDistrict(){
        $province = Province::first();
        if(isset($province)){
         $district = District::where('ProvinceId','=',$province->Id)->get();
         $arr= array('Province' =>Province::get(), 'District' => $district);

         return $arr;
        }
     }

     function ListCommune(){
        $district = District::first();
        if(isset($district)){
         $commune = Commune::where('DistrictId','=',$district->Id)->get();
         $arr= array('District' =>District::get(), 'Commune' => $commune);

         return $arr;
        }
     }

     function ListVillage(){
         $commune = Commune::first();
        if(isset($commune)){
         $village = Village::where('CommuneId','=',$commune->Id)->get();
         $arr= array('Commune' =>Commune::get(), 'Village' => $village);

         return $arr;
        }
     }
}
