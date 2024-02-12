<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function showSettings(){

        $settings = Setting::all();
        return view('admin.settings.index', compact('settings'));
    }

    public function create()
    {
        return view('admin.settings.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'top_logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'bottom_logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',

        ]);

        $imagePath = $request->file('top_logo','bottom_logo')->store('settings_images','public');

        Setting::create([
            'top_logo' => $imagePath,
            'bottom_logo' => $imagePath,
        ]);

        return redirect()->route('admin.settings')->with('success', 'Setting info added');
    }

    public function edit(Setting $setting)
    {
        return view('admin.settings.edit', compact('setting'));
    }

    public function update(Request $request, Setting $setting)
    {
        $validatedData = $request->validate([
            'top_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'bottom_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        if ($request->hasFile('top_logo')) {
            $topLogoPath = $request->file('top_logo')->store('settings_images', 'public');
            Storage::delete(public_path($setting->top_logo));
            $setting->top_logo = $topLogoPath;
        }

        if ($request->hasFile('bottom_logo')) {
            $bottomLogoPath = $request->file('bottom_logo')->store('settings_images', 'public');
            Storage::delete(public_path($setting->bottom_logo));
            $setting->bottom_logo = $bottomLogoPath;
        }
        $setting->save();

        return redirect()->route('admin.settings')->with('success', 'Settings info updated successfully');
    }

    public function destroy(Setting $setting)
    {
        Storage::delete(public_path($setting->top_logo));
        Storage::delete(public_path($setting->bottom_logo));
        $setting->delete();

        return redirect()->route('admin.settings')->with('success', 'Settings info deleted successfully');
    }

}
