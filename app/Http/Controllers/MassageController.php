<?php

namespace App\Http\Controllers;

use App\Events\NewMassageEvent;
use App\Exports\MassageExport;
use App\MassageUser;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Massage;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class MassageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $timeSlots = Massage::all()->sortByDesc("id")->first();
        if ($timeSlots !== null){
            $id = $timeSlots->id;
            $duration = $timeSlots->duration;
            $price = $timeSlots->price;
            $m_date = $timeSlots->massage_date;
            $m_date = Carbon::parse($m_date)->format('Y-m-d');
            $st = Carbon::parse($timeSlots->start);
            $en = Carbon::parse($timeSlots->end);
            $slots = $this->generateDateRange($st, $en, $duration);
            $today = Carbon::today()->toDateString();
        } else{
            $id = null;
            $m_date = null;
            $slots = null;
            $today = null;
            $duration = null;
            $price = null;
        }
        if (isset($id)) {
            $results = MassageUser::with('user')->where('massage_id', $id)->get();
        } else{
            $results = null;
        }
        return view('time-slot.index', compact([ 'm_date', 'timeSlots', 'slots', 'id', 'today', 'price', 'duration', 'results']));
       }

    public function massageView()
    {
        $massages = Massage::paginate(5);
        return view('time-slot.manage-massage', compact('massages'));
    }

    private function generateDateRange(Carbon $start_date, Carbon $end_date,$slot_duration = 15)
    {
        $dates = [];
        $slots = $start_date->diffInMinutes($end_date)/$slot_duration;

        //first unchanged time
        $dates[$start_date->toDateString()][]=$start_date->toTimeString();

        for($s = 1;$s <=$slots;$s++){

            $dates[$start_date->toDateString()][]=$start_date->addMinute($slot_duration)->toTimeString();

        }
        return $dates;
    }

    public function export(Request $request){
        if ($request->input('exportexcel') !== null ){
            return Excel::download(new MassageExport, 'massage.xlsx');
        }

        if ($request->input('exportcsv') !== null ){
            return Excel::download(new MassageExport, 'massage.csv');
        }

        return redirect()->action('MassageController@index');
    }

    public function deleteTime(Request $request)
    {
        $id = $request->input('item');
        DB::table('massage_users')->where('user_id', $id)->delete();
        return redirect()->route('massage')->with('success','Massage time was deleted successfully!');
    }

    public function destroy($id)
    {
        $massage = Massage::find($id);
        $massage->delete();
        return redirect()->route('massage-view')->with('success','Massage list was deleted successfully!');
    }

    public function edit($id)
    {
        $massages = Massage::find($id);
        return view(('time-slot.edit'), compact('massages'));
    }

    public function update(Request $request, $id)
    {
        $massage = Massage::find($id);

        $massage->start = $request->input('start');
        $massage->end = $request->input('end');
        $massage->duration = $request->input('duration');
        $massage->price = $request->input('price');
        $massage->save();

        return redirect()->route('massage-view')->with('success', 'Massage list was updated successfully!');
    }

    public function create()
    {
        return view('time-slot.create');
    }

    public function store(Request $request)
    {
       $massage = new Massage();

        $massage->start = $request->start;
        $massage->end = $request->end;
        $massage->duration = $request->duration;
        $massage->price = $request->price;
        $massage->massage_date = $request->m_date;
        $massage->save();

        //event(new NewMassageEvent());

        return redirect()->route('massage-view')->with('success', 'Massage list was created successfully!');
    }
}
