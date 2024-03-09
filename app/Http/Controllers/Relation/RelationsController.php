<?php

namespace App\Http\Controllers\Relation;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Phone;
use App\User;
use Illuminate\Http\Request;

class RelationsController extends Controller
{
    public function hasOnRelation()
    {
        $user = \App\User::with(['phone' => function ($q) {
            $q->select('code', 'phone', 'user_id');
        }])->find(11);

//       return $user -> phone;
        return response()->json($user);
    }

    public function hasOnRelationReverse()
    {
        $phone = Phone::with(['user' => function ($q) {
            $q->select('id', 'name',);
        }])->find(1);
//        return $phone ->user;
//        $phone -> makeVisible(['user_id']);    // make some attribute visible
        $phone->makeHidden(['code']);      // make some attribute hidden
        return $phone;
    }

    public function getUserHasPhone()
    {
        return User::whereHas('phone')->get();
    }

    public function getUserNotHasPhone()
    {
        return User::whereDoesntHave('phone')->get();
    }

    public function getUserWhereHasPhoneWithCondition()
    {
        return User::whereHas('phone', function ($q) {
            $q->where('code', '02');
        })->get();
    }

    ################### one to many relationship method ##################

    public function getHospitalDoctors()
    {
        $hospial = Hospital::with('doctors')->find(1);
//        return $hospial -> doctors;
//        return $hospial -> name;
        $doctors = $hospial->doctors;

        foreach ($doctors as $doctor) {
            echo $doctor->name . '<br>';
        }

        $doctor = Doctor::find(3);
        return $doctor->hospital->name;
    }


    public function hospitals()
    {
        $hospitals = Hospital::select('id', 'name', 'address')->get();
        return view('doctors.hospitals', compact('hospitals'));
    }

    public function doctors($hospital_id)
    {
        $hospital = Hospital::find($hospital_id);
        $doctors = $hospital->doctors;
        return view('doctors.doctors', compact('doctors'));
    }

    public function hospitalHasDoctor()
    {
        return $hospitals = Hospital::whereHas('doctors')->get();
    }

    public function hospitalHasOnlyMale()
    {
        return $hospitals = Hospital::with('doctors')->whereHas('doctors', function ($q) {
            $q->where('gender', '1');
        })->get();
    }

    public function hospitalNotHasDoctor()
    {
        return $hospitals = Hospital::whereDoesntHave('doctors')->get();
    }

    public function deleteHospital($hospital_id)
    {
        $hospital = Hospital::find($hospital_id);
        if (!$hospital)
            return abort('404');
        //delete doctors in this hospital
        $hospital->doctors()->delete();
        $hospital->delete();

        return redirect() -> route('hospital.all');
    }

    ################### one to many relationship method ##################
}
