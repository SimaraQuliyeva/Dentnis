<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\TvProgram;
use Illuminate\Http\Request;

class TvProgramController extends Controller
{
    public function showTvPrograms(){
        $programs = TvProgram::all();
        return view('admin.tv-programs.index', compact('programs'));
    }

    public function create()
    {
        return view('admin.tv-programs.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string',
            'url' => 'required'

        ]);

        TvProgram::create([
            'url' => $validatedData['url'],
            'title' => $validatedData['title'],
        ]);

        return redirect()->route('admin.tv-programs')->with('success', 'TV Program added');
    }

    public function edit(TvProgram $program){
        return view('admin.tv-programs.edit', compact('program'));
    }

    public function update(Request $request, TvProgram $program)
    {
        $request->validate([
            'url' => 'required',
            'title'=>'required'
        ]);

        $program->url = $request->input('url');
        $program->title = $request->input('title');
        $program->save();

        return redirect()->route('admin.tv-programs')->with('success', 'tv-programs updated successfully!');
    }


    public function destroy(TvProgram $program)
    {
        $program->delete();
        $program->delete();

        return redirect()->route('admin.tv-programs')->with('success', 'tv-programs deleted successfully!');
    }


}
