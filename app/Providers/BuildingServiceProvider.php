<?php

namespace App\Providers;

use App\Http\Model\UserBuilding;
use App\User;
use Illuminate\Support\ServiceProvider;
use App\Http\Model\Building;
use Illuminate\Http\Request;
use Illuminate\Session;


class BuildingServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    //public function boot(Request $request)
    public function boot()
    {

        $building = Building::get();

        $user_building= User::select('building.name','building.building_id','users.id')->Join('user_building','user_building.user_id','=','users.id')
            ->Join('building','building.building_id','=','user_building.building_id')->get();
        /* print_r($user_building);
         exit();*/

        $user = User::get();
        //$defaultBuilding = $request->session()->get('defaultBuilding');



        //view()->share(['selected_building' => $building, 'defaultBuilding' => $defaultBuilding]);
        view()->share(['selected_building' => $building]);
        view()->share(['user' => $user]);
        view()->share(['user_building' => $user_building]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
