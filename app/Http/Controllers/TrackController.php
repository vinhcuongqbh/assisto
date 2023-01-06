<?php

namespace App\Http\Controllers;

use App\Models\TrackReportType;
use App\Models\TrackReportMedia;
use App\Models\Track;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TrackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->roleId != 3) return view('admin.track.index');
        else return view('staff.track.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $trackReportType = TrackReportType::all();

        if (Auth::user()->roleId != 3) return view('admin.track.create', ['trackReportTypes' => $trackReportType]);
        else return view('staff.track.create', ['trackReportTypes' => $trackReportType]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Kiểm tra thông tin đầu vào
        $validated = $request->validate([
            'date' => 'required',
            'time' => 'required',
            'place' => 'required',
            'classify' => 'required',
            'title' => 'required',
        ]);

        $track = new Track;
        $track->track_date = $request->date;
        $track->track_time = $request->time;
        $track->track_place = $request->place;
        $track->track_type_id = $request->classify;
        $track->track_title = $request->title;
        $track->track_content = $request->content;
        $track->staff_id = Auth::id();
        $track->create_date = Carbon::now();
        switch ($request->input('action')) {
            case 'draft':
                $track->track_status = 1;
                break;
            case 'report':
                $track->track_status = 2;
                break;
        }
        $track->save();

        //Xử lý ảnh tải lên
        if ($request->hasFile('files')) {
            $allowedfileExtension = ['pdf', 'jpg', 'png', 'docx', 'doc', 'xlsx', 'xls'];
            $files = $request->file('files');
            foreach ($files as $file) {
                //$filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $check = in_array($extension, $allowedfileExtension);
                if ($check) {
                    $path = $file->store('public/File');
                    $path = substr($path, strlen('public/'));
                    $trackReportMedia = new TrackReportMedia;
                    $trackReportMedia->track_report_media_url = $path;
                    $trackReportMedia->track_report_id = $track->track_id;
                    $trackReportMedia->insert_date = Carbon::now();
                    $trackReportMedia->save();
                }
            }
        } else {
            echo '<div class="alert alert-warning"><strong>Warning!</strong> Sorry Only Upload png , jpg , doc</div>';
        }

        if (Auth::user()->roleId != 3) return redirect()->route('track.show', ['id' => $track->track_id]);
        else return redirect()->route('staff.track.show', ['id' => $track->track_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $track = Track::where('track_id', $id)
            ->leftjoin('asahi_track_report_type', 'asahi_track_report_type.track_type_id', 'asahi_track_report.track_type_id')
            ->leftjoin('asahi_track_report_status', 'asahi_track_report_status.track_status_id', 'asahi_track_report.track_status')
            ->select('asahi_track_report.*', 'asahi_track_report_type.track_type_name', 'asahi_track_report_status.track_status_name')
            ->first();

        $trackReportMedia = TrackReportMedia::where('track_report_id', $id)->get();

        if (Auth::user()->roleId != 3) return view('admin.track.show', ['track' => $track, 'trackReportMedias' => $trackReportMedia]);
        else return view('staff.track.show', ['track' => $track, 'trackReportMedias' => $trackReportMedia]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $track = Track::where('track_id', $id)
            ->leftjoin('asahi_track_report_type', 'asahi_track_report_type.track_type_id', 'asahi_track_report.track_type_id')
            ->leftjoin('asahi_track_report_status', 'asahi_track_report_status.track_status_id', 'asahi_track_report.track_status')
            ->select('asahi_track_report.*', 'asahi_track_report_type.track_type_name', 'asahi_track_report_status.track_status_name')
            ->first();

        $trackReportMedia = TrackReportMedia::where('track_report_id', $id)->get();
        $trackReportType = TrackReportType::all();

        if (Auth::user()->roleId != 3) return view('admin.track.edit', ['track' => $track, 'trackReportMedias' => $trackReportMedia, 'trackReportTypes' => $trackReportType]);
        else return view('staff.track.edit', ['track' => $track, 'trackReportMedias' => $trackReportMedia, 'trackReportTypes' => $trackReportType]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Kiểm tra thông tin đầu vào
        $validated = $request->validate([
            'date' => 'required',
            'time' => 'required',
            'place' => 'required',
            'classify' => 'required',
            'title' => 'required',
        ]);

        $track = Track::where('track_id', $id)->first();
        $track->track_date = $request->date;
        $track->track_time = $request->time;
        $track->track_place = $request->place;
        $track->track_type_id = $request->classify;
        $track->track_title = $request->title;
        $track->track_content = $request->content;
        $track->staff_id = Auth::id();
        $track->last_update_date = Carbon::now();
        switch ($request->input('action')) {
            case 'draft':
                $track->track_status = 1;
                break;
            case 'report':
                $track->track_status = 2;
                break;
        }
        $track->save();

        //Xử lý ảnh tải lên
        if ($request->hasFile('files')) {
            $allowedfileExtension = ['pdf', 'jpg', 'png', 'docx', 'doc', 'xlsx', 'xls'];
            $files = $request->file('files');
            foreach ($files as $file) {
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $check = in_array($extension, $allowedfileExtension);
                if ($check) {
                    $path = $file->store('public/File');
                    $path = substr($path, strlen('public/'));
                    $trackReportMedia = new TrackReportMedia;
                    $trackReportMedia->track_report_media_url = $path;
                    $trackReportMedia->track_report_id = $track->track_id;
                    $trackReportMedia->insert_date = Carbon::now();
                    $trackReportMedia->save();
                }
            }
        }

        if (Auth::user()->roleId != 3) return redirect()->route('track.show', ['id' => $track->track_id]);
        else return redirect()->route('staff.track.show', ['id' => $track->track_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function deletefile($id)
    {
        $trackReportMedia = TrackReportMedia::where('track_report_media_id', $id)->first();
        $trackReportMedia->delete();
        return back();
    }



    public function search(Request $request)
    {
        if (Auth::user()->roleId != 3) {
            $track = Track::where('track_date', $request->date)
            ->leftjoin('asahi_track_report_status', 'asahi_track_report_status.track_status_id', 'asahi_track_report.track_status')
            ->select('asahi_track_report.*', 'asahi_track_report_status.track_status_name')
            ->get();
        } else {
            $track = Track::where('track_date', $request->date)
            ->where('staff_id', Auth::id())
            ->leftjoin('asahi_track_report_status', 'asahi_track_report_status.track_status_id', 'asahi_track_report.track_status')
            ->select('asahi_track_report.*', 'asahi_track_report_status.track_status_name')
            ->get();
        }

        if (Auth::user()->roleId != 3) return view('admin.track.result', ['tracks' => $track, 'date' => $request->date]);
        else return view('staff.track.result', ['tracks' => $track, 'date' => $request->date]);
    }

    

    public function report($id)
    {
        $track = Track::where('track_id', $id)->first();
        $track->track_status = 2;
        $track->save();

        if (Auth::user()->roleId != 3) return redirect()->route('track.show', ['id' => $track->track_id]);
        else return redirect()->route('staff.track.show', ['id' => $track->track_id]);
        
    }
}
