<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Quotes;
use App\Models\QuotesTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class QuoteController extends Controller
{
    public function showQuotes($lang){
        $quotes = Quotes::with(['translations' => function ($query) use ($lang) {
            $query->whereHas('language', function ($subquery) use ($lang) {
                $subquery->where('lang', $lang);
            });
        }])->get();
//        $quotes = Quotes::all();
        return view('admin.quotes.index', compact('quotes'));
    }

    public function create()
    {
        $languages = [];
        return view('admin.quotes.create');
    }


    public function store(Request $request)
    {
        $validationRules=[
            'image'=>'required|image|mimes:jpeg,png,jpg,gif,svg',

        ];
        $langs=config('app.languages');
        foreach ($langs as $lang){
            $validationRules["$lang.title"]='required';
            $validationRules["$lang.description"]='required';
        }
        $request->validate($validationRules);

        $quote = new Quotes();
        $quote->image = $request->file('image')->store('quotes_images', 'public');
        $quote->save();

        foreach (config('app.languages') as $lang) {
            $language = Language::where('lang', $lang)->first();
            $langId = $language->id;

            // Translation varsa dəyiş, yoxsa yarat
            $quoteTranslation = new QuotesTranslation();
            $quoteTranslation->title = $request->input("$lang.title");
            $quoteTranslation->description = $request->input("$lang.description");
            $quoteTranslation->quote_id = $quote->id;
            $quoteTranslation->language_id = $langId;
            $quoteTranslation->save();
        }

        return redirect()->route('admin.quotes', ['lang'=>'tr'])->with('success', 'Quote has been added');
    }


    public function edit(Quotes $quote)
    {
        return view('admin.quotes.edit', compact('quote'));
    }

    public function update(Request $request)
    {

        $langs = config('app.languages');
//        dd($request->all());

        $validationRules = [];
        foreach ($langs as $lang) {
            $validationRules["$lang.title"] = 'required';
            $validationRules["$lang.description"] = 'required';
        }
        $validationRules['image'] = 'image|mimes:jpeg,png,jpg,gif|max:2048';


        $request->validate($validationRules);
//        dd($request->all());

        $quoteId = $request->input('quoteId');
        $quote = Quotes::find($quoteId);

        foreach ($langs as $lang) {
            $language = Language::where('lang', $lang)->first();
            $langId = $language->id;

            $quoteTranslation = QuotesTranslation::updateOrCreate(
                ['quote_id' => $quoteId, 'language_id' => $langId],
                ['title' => $request->input("$lang.title"),
                    'description' => $request->input("$lang.description"),
                    'quote_id' => $quoteId,
                ]
            );

            $quoteTranslation->title = $request->input("$lang.title");
            $quoteTranslation->description = $request->input("$lang.description");
            $quoteTranslation->quote_id= $quoteId;
            $quoteTranslation->save();
        }
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('quotes_images');
            Storage::delete($quote->image);
            $quote->image = $imagePath;
        }

            $quote->save();


        return redirect()->route('admin.quotes',['lang'=>'tr'])->with('success', 'Quote updated successfully!');
    }


    public function destroy(Quotes $quote)
    {
        if ($quote) {
            $quote->translations()->delete();
            if (Storage::disk('public')->exists($quote->image)) {
                Storage::disk('public')->delete($quote->image);
            }
            $quote->delete();

            return redirect()->back()->with('success', 'Has been deleted successfully!');
        } else {
            return redirect()->back()->with('error', 'Quote not found.');
        }
    }

}
