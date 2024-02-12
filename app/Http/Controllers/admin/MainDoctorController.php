<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\MainDoctor;
use App\Models\MainDoctorTranslation;
use Illuminate\Http\Request;

class MainDoctorController extends Controller
{
    public function showMainDoctor()
    {
        $doctors = MainDoctor::all();
        return view('admin.main-doctor.index', compact('doctors'));
    }


    public function create()
    {
        $languages = [];
        return view('admin.main-doctor.create');
    }


    public function store(Request $request)
    {
        $langs = config('app.languages');

        $validationRules = [];
        foreach ($langs as $lang) {
            $validationRules["description_$lang"] = 'required|string';
        }

        $request->validate($validationRules);
        //dd($request->all());
        $doctor = new MainDoctor();
        $doctor->save();
        foreach ($langs as $lang) {
            $language = Language::where('lang', $lang)->first();
            $langId = $language->id;

            $translation = new MainDoctorTranslation();
            $translation->description = $request->input("description_$lang");
            $translation->head_doctor_id = $doctor->id;
            $translation->language_id = $langId;
            $translation->save();
        }

        return redirect()->route('admin.main-doctor', ['lang' => 'tr'])->with('success', 'Doctor info added!');
    }

    public function edit(MainDoctor $doctor)
    {
        return view('admin.main-doctor.edit', compact('doctor'));
    }

    public function update(Request $request)
    {
        $langs = config('app.languages');


        $validationRules = [];
        foreach ($langs as $lang) {
            $validationRules["description_$lang"] = 'required';
        }
        $request->validate($validationRules);

        $doctorId = $request->input('doctorId');
        $doctorId = MainDoctor::find($doctorId);

        foreach ($langs as $lang) {
            $language = Language::where('lang', $lang)->first();
            $langId = $language->id;

            $doctorTranslation = new MainDoctorTranslation();
            $doctorTranslation->head_doctor_id = $doctorId;
            $doctorTranslation->language_id = $langId;
            $doctorTranslation->description = $request->input("description_$lang");
            $doctorTranslation->save();
        }
//        $category->save();

        return redirect()->route('admin.main-doctor',['lang'=>'tr'])->with('success', 'Doctor info updated successfully!');
    }

    public function destroy(MainDoctor $doctor){
        if ($doctor) {
            $doctor->translations()->delete();
//
            $doctor->delete();

            return redirect()->back()->with('success', 'Has been deleted successfully!');
        } else {
            return redirect()->back()->with('error', 'Info not found.');
        }
    }

}

