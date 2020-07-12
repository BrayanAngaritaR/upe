<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Calendar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CalendarController extends Controller
{
    public function index()
    {
        $calendars    = Calendar::get();
        $calendarEvents = [];
        foreach($calendars as $calendar)
        {
            $arr = [];

            $arr['id']              = $calendar['id'];
            $arr['title']           = $calendar['title'];
            $arr['start']           = $calendar['start_date'];
            $arr['end']             = $calendar['end_date'];
            $arr['backgroundColor'] = $calendar['color'];
            $arr['borderColor']     = "#fff";
            $arr['textColor']       = "white";
            $arr['url']             = route('calendars.edit', $calendar['id']);

            $calendarEvents[] = $arr;
        }
        $calendarEvents = str_replace('"[', '[', str_replace(']"', ']', json_encode($calendarEvents)));

        return view('admin.calendars.index', compact('calendarEvents'));
    }

    public function create()
    {
        return view('admin.calendars.create');
    }

    public function store(Request $request)
    {
        $validator = \Validator::make(
            $request->all(), [
                               'title' => 'required',
                               'start_date' => 'required',
                               'end_date' => 'required',
                               'color' => 'required',
                           ]
        );
        if($validator->fails())
        {
            $messages = $validator->getMessageBag();

            return redirect()->back()->with('error', $messages->first());
        }

        $calendar                = new Calendar();
        $calendar->title         = $request->title;
        $calendar->start_date    = $request->start_date;
        $calendar->end_date      = $request->end_date;
        $calendar->color         = $request->color;
        $calendar->description   = $request->description;
        $calendar->created_by    = Auth::user()->getCreatedBy();
        $calendar->save();

        return redirect()->route('calendars.index')->with('success', __('Calendar  successfully created.'));
    }

    public function show(Calendar $calendar)
    {
        return redirect()->route('calendars.index');
    }

    public function edit($calendar)
    {
        $calendar = Calendar::find($calendar);
        if($calendar->created_by ==Auth::user()->getCreatedBy())
        {
            return view('admin.calendars.edit', compact('calendar'));
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    public function update(Request $request, Calendar $calendar)
    {
        $validator = \Validator::make(
            $request->all(), [
                               'title' => 'required',
                               'start_date' => 'required',
                               'end_date' => 'required',
                               'color' => 'required',
                           ]
        );
        if($validator->fails())
        {
            $messages = $validator->getMessageBag();

            return redirect()->back()->with('error', $messages->first());
        }

        $calendar->title       = $request->title;
        $calendar->start_date  = $request->start_date;
        $calendar->end_date    = $request->end_date;
        $calendar->color       = $request->color;
        $calendar->description = $request->description;
        $calendar->save();

        return redirect()->route('calendars.index')->with('success', __('Calendar successfully updated.'));
    }

    public function destroy(Calendar $calendar)
    {
        if($calendar->created_by == Auth::user()->getCreatedBy())
        {
            $calendar->delete();

            return redirect()->route('calendars.index')->with('success', __('Calendar successfully deleted.'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
}
