<?php

namespace App\Http\Controllers\Relation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hospital;
use App\Models\Doctor;
use App\Models\Service;

class RelationsController extends Controller
{

    // One To Many
    public function getHospitalDoctors()
    {
        $hospitalWithDoctors = Hospital::with('doctors')->find(1); // Hospital::where('id', 1) -> first();
        // $doctors = $hospital->doctors;
        $hospital =  Doctor::find(3)->hospital;

        return $hospitalWithDoctors;
    }
    public function getHospitalHasDoctors()
    {
        $hospitalWithDoctors = Hospital::whereHas('doctors')->get();

        return $hospitalWithDoctors;
    }
    public function getHospitalHasDoctorsAndMale()
    {
        $hospitalWithDoctors = Hospital::whereHas('doctors', function ($q) {
            $q->where('gender', 1);
        })->with('doctors')->get();

        return $hospitalWithDoctors;
    }
    public function getHospitalNotHasDoctorsAnd()
    {
        $hospitalWithDoctors = Hospital::whereDoesNtHave('doctors')->get();

        return $hospitalWithDoctors;
    }

    public function deleteHospital($hospital_id) {
        $hospital = Hospital::find($hospital_id);

        // $hospital->doctors()->delete();

        if($hospital) {
            $hospital->delete();
            return redirect()->route("dashboard");
        }else {
            return abort('404');
        }
    }


    // Many To Many
    public function getDoctorsServices() {
        $doctorService = Doctor::with(['services', 'hospital'])->find(3);
        // $doctorService = Doctor::with(['services', 'hospital'])->get();
        // $doctorService = Doctor::with('services')->find(3);
        // $hidden = $doctorService->makeHidden('services.pivot');
        // foreach($doctorService as $doctor){
        //     $doctor->services->makeHidden('pivot');
        // }

        return $doctorService;
    }
    public function getServicesDoctors() {
        $doctorService = Service::with([
            'doctors'=>
            function ($q) {
                $q->select('doctors.id', 'name', 'title');
        }])->find(1);
        // $doctorService = Service::with('doctors')->get();
        // foreach($doctorService->doctors as $doctor){
        //     $doctor->makeHidden('pivot');
        // }

        return $doctorService;
    }
    public function getDoctorServicesById($doctorId)
    {
        $doctor = Doctor::find($doctorId);
        $doctorServices = $doctor->services;

        $doctors = Doctor::select('id', 'name')->get();
        $services = Service::select('id', 'name')->get();

        return response()->json(["status" => 201, "data" => [$doctors, $services]]);
    }
    public function SaveServicesToDoctors(Request $request)
    {
        $doctor = Doctor::find($request->doctor_id);
        // Check If Find Doctor
        if(!$doctor) {
            return abort('404');
        }

        // $doctor ->services()->attach($request->servicesIds); // many to many insert to database
        // $doctor ->services()->sync($request->servicesIds); // [Update] many to many insert to database Any IDs that are not in the given array will be removed from the intermediate table
        $doctor ->services()->syncWithoutDetaching($request->servicesIds); // [Add] many to many insert and do not detach existing IDs that are missing from the given array
        return $request;
    }

    ######################### Begin accessors and mutators #########################
    public function accessorsGetDoctors()
    {
        $doctors = Doctor::select('id', 'name', 'gender')->get();
        return $doctors;
    }
    ######################### End accessors and mutators #########################
}