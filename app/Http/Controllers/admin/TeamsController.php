<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Team;
use App\Models\TeamTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeamsController extends Controller
{
    public function showTeams($lang)
    {
//        $lang ='tr';
        $teams = Team::with(['translations' => function ($query) use ($lang) {
            $query->whereHas('language', function ($subquery) use ($lang) {
                $subquery->where('lang', $lang);
            });
        }])->get();
//        $teams = Team::all();
//        dd($teams);
        return view('admin.teams.index', compact('teams'));
    }

    public function create()
    {
        return view('admin.teams.create');
    }

    public function store(Request $request)
    {
        $validationRules=[
            'image'=>'required|image|mimes:jpeg,png,jpg,gif,svg',
            'name'=>'required'

        ];
        $langs=config('app.languages');
        foreach ($langs as $lang){
            $validationRules["$lang.position"]='required';
        }
        $request->validate($validationRules);
//        dd($request->all());
//        $validatedData = $request->validate([
//            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
//            'title' => 'required|string',
//            'language' => 'required|string|in:tr,en,ru',
//            'position' => 'required|string',
//        ]);

//        $imagePath = $request->file('image')->store('teams_images');

        $team = new Team();
        $team->image = $request->file('image')->store('teams_images', 'public');
        $team->title = $request->input('name');
        $team->save();

        foreach (config('app.languages') as $lang) {
            $language = Language::where('lang', $lang)->first();
            $langId = $language->id;

            // Translation varsa dəyiş, yoxsa yarat
            $teamTranslation = new TeamTranslation();
            $teamTranslation->position = $request->input("$lang.position");
            $teamTranslation->teams_id = $team->id;
            $teamTranslation->language_id = $langId;
            $teamTranslation->save();
        }

        return redirect()->route('admin.teams', ['lang'=>'tr'])->with('success', 'Takım üyesi eklendi');
    }

    public function edit(Team $team)
    {
        return view('admin.teams.edit', compact('team'));
    }

    public function update(Request $request)
    {

        $langs = config('app.languages');
//        dd($request->all());

        $validationRules = [];
        foreach ($langs as $lang) {
            $validationRules["$lang.position"] = 'required';
        }
        $validationRules['image'] = 'image|mimes:jpeg,png,jpg,gif|max:2048';
        $validationRules['name'] = 'string';

        $request->validate($validationRules);
//        dd($request->all());

        $teamId = $request->input('teamId');
        $team = Team::find($teamId);

        foreach ($langs as $lang) {
            $language = Language::where('lang', $lang)->first();
            $langId = $language->id;

            $teamTranslation = TeamTranslation::updateOrCreate(
                ['teams_id' => $teamId, 'language_id' => $langId],
                ['position' => $request->input("$lang.position"),
//                    'teams_id' => $teamId,
                ]
            );

            $teamTranslation->position = $request->input("$lang.position");
            $teamTranslation->teams_id= $teamId;
            $teamTranslation->save();
        }
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('teams_images');
            Storage::delete($team->image);
            $team->image = $imagePath;
        }
//       $team->title=$request->input('name');

        $team->save();


        return redirect()->route('admin.teams',['lang'=>'tr'])->with('success', 'Team member updated successfully!');
    }



    public function destroy(Team $team)
    {
        if ($team) {
            $team->translations()->delete();
            if (Storage::disk('public')->exists($team->image)) {
                Storage::disk('public')->delete($team->image);
            }
            $team->delete();

            return redirect()->back()->with('success', 'Has been deleted successfully!');
        } else {
            return redirect()->back()->with('error', 'Team not found.');
        }
    }
}
