<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use App\Http\Model\Applicant;
use Illuminate\Support\Facades\Response;

class Tenant extends Model
{
    //
    protected $table = 'tenant';
    public $timestamps = true;
    protected $primaryKey = "id";


    public function  ApplicantToTenant($ap_id){
        $new =true;
        $applicant = Applicant::where('applicant_id',$ap_id)->first();
        if(Tenant::where('applicant',$ap_id)->count()){
            $tenant = Tenant::where('applicant',$ap_id)->first();
            $newTenant = Tenant::find($tenant->id);
            $new =false ;
        } else {
             $newTenant = new Tenant;
        }
        $newTenant->name = $applicant->name;
        $newTenant->email = $applicant->email;
        $newTenant->phone = $applicant->phone;
        $newTenant->lease_perfer = $applicant->lease_perfer;
        $newTenant->profile = $applicant->profile;
        $newTenant->applicant = $ap_id;
        $newTenant->save();

        if($new){
            $id = $newTenant->id;
            Response::json(array('success' => true, 'last_insert_id' => $id ), 200);

        } else {
            $id = $tenant->id;
        }
        return $id;
    }
}
