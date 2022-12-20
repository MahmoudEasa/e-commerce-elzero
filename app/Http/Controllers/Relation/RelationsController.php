<?php

namespace App\Http\Controllers\Relation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hospital;
use App\Models\Doctor;
use App\Models\Service;

class RelationsController extends Controller
{
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
}