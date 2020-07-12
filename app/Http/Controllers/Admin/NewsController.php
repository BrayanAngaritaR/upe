<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::where('created_by', '=', Auth::user()->getCreatedBy())->orderBy('id', 'DESC')->get();

        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(), [
                               'from' => 'required|date|after_or_equal:' . date('d-m-Y'),
                               'to' => 'required|date|after_or_equal:from',
                               'color' => 'required',
                               'description' => 'required',
                           ]
        );

        if($validator->fails())
        {
            return redirect()->back()->with('error', $validator->errors()->first());
        }

        $news['from']        = date('Y-m-d', strtotime($request->input('from')));
        $news['to']          = date('Y-m-d', strtotime($request->input('to')));
        $news['color']       = $request->input('color');
        $news['description'] = $request->input('description');
        $news['created_by']  = Auth::user()->getCreatedBy();

        News::create($news);

        return redirect()->route('news.index')->with('success', __('News added successfully.'));
    }

    public function show(News $news)
    {
        return redirect()->back()->with('error', __('Permission denied.'));
    }

    public function edit(News $news)
    {
        return view('admin.news.edit', compact('notification'));
    }

    public function update(Request $request, News $news)
    {
        $validator = Validator::make(
            $request->all(), [
                               'from' => 'required|date|after_or_equal:' . date('d-m-Y'),
                               'to' => 'required|date|after_or_equal:from',
                               'color' => 'required',
                               'description' => 'required',
                           ]
        );

        if($validator->fails())
        {
            return redirect()->back()->with('error', $validator->errors()->first());
        }

        $news['from']        = date('Y-m-d', strtotime($request->input('from')));
        $news['to']          = date('Y-m-d', strtotime($request->input('to')));
        $news['color']       = $request->input('color');
        $news['description'] = $request->input('description');

        $news->save();

        return redirect()->route('news.index')->with('success', __('News updated successfully.'));
    }

    public function destroy(News $news)
    {
        $news->delete();

        return redirect()->route('news.index')->with('success', __('News deleted successfully.'));
    }

    public function changeNewsStatus(Request $request, $id)
    {
        $response = false;
        $status = $request->has('status') ? $request->status : 0;

        $news = News::find($id);

        if($news)
        {
            $news->status = $status;
            $news->save();

            $response = true;
        }

        echo json_encode($response);
    }
}
