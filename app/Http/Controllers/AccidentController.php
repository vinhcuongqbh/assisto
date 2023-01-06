<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Accident;
use App\Models\AccidentCar;
use App\Models\AccidentCarMedia;
use App\Models\AccidentMedia;
use App\Models\AccidentPeople;
use App\Models\AccidentPeopleMedia;
use App\Models\RoadType;
use Carbon\Carbon;

class AccidentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->roleId != 3) return view('admin.accident.index');
        else return view('staff.accident.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roadType = RoadType::all();

        if (Auth::user()->roleId != 3) return view('admin.accident.create', ['roadTypes' => $roadType]);
        else return view('staff.accident.create', ['roadTypes' => $roadType]);
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
            'date' => 'required|unique:App\Models\Store,storeId',
            'time' => 'required',
            'collisionPoint' => 'required'
        ]);

        $accident = new Accident;
        $accident->staff_id = Auth::id();
        $accident->our_truck_speed = $request->ourTruckSpeed;
        $accident->our_truck_repair_garage_addr = $request->ourTruckRepairGarageAddress;
        $accident->our_truck_repair_garage_tel = $request->ourTruckRepairGarageTel;
        $accident->onsite_road_type = $request->roadType;
        $accident->onsite_road_width = $request->roadWidth;
        $accident->onsite_outlook = $request->outlook;
        $accident->onsite_traffic_signs = $request->trafficSign;
        $accident->acc_date = $request->date;
        $accident->acc_time = $request->time;
        $accident->onsite_collision_point = $request->collisionPoint;
        $accident->onsite_park_position = $request->parkPosition;
        $accident->onsite_victim = $request->victim;
        $accident->onsite_witness = $request->witness;
        $accident->acc_content = $request->content;
        switch ($request->input('action')) {
            case 'draft':
                $accident->acc_status = 1;
                break;
            case 'report':
                $accident->acc_status = 2;
                break;
        }
        $accident->save();
        //Xử lý Insurance Image tải lên
        if ($request->hasFile('accidentImage')) {
            $allowedfileExtension = ['jpg', 'jpeg', 'png', 'bmp'];
            $files = $request->file('accidentImage');
            foreach ($files as $file) {
                //$filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $check = in_array($extension, $allowedfileExtension);
                if ($check) {
                    $path = $file->store('public/File');
                    $path = substr($path, strlen('public/'));
                    $accidentMedia = new AccidentMedia();
                    $accidentMedia->acc_media_url = $path;
                    $accidentMedia->acc_id = $accident->acc_id;
                    $accidentMedia->insert_date = Carbon::now();
                    $accidentMedia->save();
                }
            }
        }


        $accidentPeople = new AccidentPeople;
        $accidentPeople->acc_id = $accident->acc_id;
        $accidentPeople->acc_involved_people_name = $request->peopleName;
        $accidentPeople->acc_involved_people_addr = $request->peopleAddress;
        $accidentPeople->acc_involved_people_contact = $request->peopleContact;
        $accidentPeople->acc_involved_people_tel = $request->peopleTelephone;
        $accidentPeople->acc_involved_people_company = $request->peopleCompany;
        $accidentPeople->acc_involved_people_other = $request->otherPeopleName;
        $accidentPeople->acc_involved_people_other_contact = $request->otherPeopleContact;
        $accidentPeople->acc_involved_people_insurance_company = $request->insuranceCompanyName;
        $accidentPeople->acc_involved_people_insurance_number = $request->insuranceNumber;
        $accidentPeople->insert_date = Carbon::now();
        $accidentPeople->save();
        //Xử lý Insurance Image tải lên
        if ($request->hasFile('carImage')) {
            $allowedfileExtension = ['jpg', 'jpeg', 'png', 'bmp'];
            $files = $request->file('insuranceImage');
            foreach ($files as $file) {
                //$filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $check = in_array($extension, $allowedfileExtension);
                if ($check) {
                    $path = $file->store('public/File');
                    $path = substr($path, strlen('public/'));
                    $accidentPeopleMedia = new AccidentPeopleMedia;
                    $accidentPeopleMedia->insurance_media_url = $path;
                    $accidentPeopleMedia->acc_involved_people_id = $accidentPeople->acc_involved_people_id;
                    $accidentPeopleMedia->insert_date = Carbon::now();
                    $accidentPeopleMedia->save();
                }
            }
        }

        $accidentCar = new AccidentCar;
        $accidentCar->acc_involved_people_id = $accidentPeople->acc_involved_people_id;
        $accidentCar->car_number_palette = $request->carNumberPalette;
        $accidentCar->car_type = $request->carType;
        $accidentCar->car_color = $request->carColor;
        $accidentCar->car_speed = $request->carSpeed;
        $accidentCar->car_repair_garage = $request->carRepairGarageAddress;
        $accidentCar->car_repair_garage_tel = $request->carRepairGarageTel;
        $accidentCar->insert_date = Carbon::now();
        $accidentCar->save();
        //Xử lý Car Image tải lên
        if ($request->hasFile('carImage')) {
            $allowedfileExtension = ['jpg', 'jpeg', 'png', 'bmp'];
            $files = $request->file('carImage');
            foreach ($files as $file) {
                //$filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $check = in_array($extension, $allowedfileExtension);
                if ($check) {
                    $path = $file->store('public/File');
                    $path = substr($path, strlen('public/'));
                    $accidentCarMedia = new AccidentCarMedia();
                    $accidentCarMedia->car_media_url = $path;
                    $accidentCarMedia->involved_car_id = $accidentCar->involved_car_id;
                    $accidentCarMedia->insert_date = Carbon::now();
                    $accidentCarMedia->save();
                }
            }
        }

        if (Auth::user()->roleId != 3) return redirect()->route('accident.show', ['id' => $accident->acc_id]);
        else return redirect()->route('staff.accident.show', ['id' => $accident->acc_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $accident = Accident::where('asahi_accident_report.acc_id', $id)
            ->leftjoin('asahi_accident_road_type', 'asahi_accident_road_type.road_type_id', 'asahi_accident_report.onsite_road_type')
            ->leftjoin('asahi_track_report_status', 'asahi_track_report_status.track_status_id', 'asahi_accident_report.acc_status')
            ->select('asahi_accident_report.*', 'asahi_accident_road_type.road_type_name', 'asahi_track_report_status.track_status_name')
            ->first();

        $accidentMedia = AccidentMedia::where('acc_id', $accident->acc_id)->get();
        $accidentPeople = AccidentPeople::where('acc_id', $accident->acc_id)->first();
        $accidentPeopleMedia = AccidentPeopleMedia::where('acc_involved_people_id', $accidentPeople->acc_involved_people_id)->get();
        $accidentCar = AccidentCar::where('acc_involved_people_id', $accidentPeople->acc_involved_people_id)->first();
        $accidentCarMedia = AccidentCarMedia::where('involved_car_id', $accidentCar->involved_car_id)->get();

        if (Auth::user()->roleId != 3) return view('admin.accident.show', [
            'accident' => $accident,
            'accidentMedias' => $accidentMedia,
            'accidentPeople' => $accidentPeople,
            'accidentPeopleMedias' => $accidentPeopleMedia,
            'accidentCar' => $accidentCar,
            'accidentCarMedias' => $accidentCarMedia
        ]);
        else return view('staff.accident.show', [
            'accident' => $accident,
            'accidentMedias' => $accidentMedia,
            'accidentPeople' => $accidentPeople,
            'accidentPeopleMedias' => $accidentPeopleMedia,
            'accidentCar' => $accidentCar,
            'accidentCarMedias' => $accidentCarMedia
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roadType = RoadType::all();
        $accident = Accident::where('asahi_accident_report.acc_id', $id)
            ->leftjoin('asahi_accident_road_type', 'asahi_accident_road_type.road_type_id', 'asahi_accident_report.onsite_road_type')
            ->leftjoin('asahi_track_report_status', 'asahi_track_report_status.track_status_id', 'asahi_accident_report.acc_status')
            ->select('asahi_accident_report.*', 'asahi_accident_road_type.road_type_name', 'asahi_track_report_status.track_status_name')
            ->first();

        $accidentMedia = AccidentMedia::where('acc_id', $accident->acc_id)->get();
        $accidentPeople = AccidentPeople::where('acc_id', $accident->acc_id)->first();
        $accidentPeopleMedia = AccidentPeopleMedia::where('acc_involved_people_id', $accidentPeople->acc_involved_people_id)->get();
        $accidentCar = AccidentCar::where('acc_involved_people_id', $accidentPeople->acc_involved_people_id)->first();
        $accidentCarMedia = AccidentCarMedia::where('involved_car_id', $accidentCar->involved_car_id)->get();

        if (Auth::user()->roleId != 3) return view('admin.accident.edit', [
            'roadTypes' => $roadType,
            'accident' => $accident,
            'accidentMedias' => $accidentMedia,
            'accidentPeople' => $accidentPeople,
            'accidentPeopleMedias' => $accidentPeopleMedia,
            'accidentCar' => $accidentCar,
            'accidentCarMedias' => $accidentCarMedia
        ]);
        else return view('staff.accident.edit', [
            'roadTypes' => $roadType,
            'accident' => $accident,
            'accidentMedias' => $accidentMedia,
            'accidentPeople' => $accidentPeople,
            'accidentPeopleMedias' => $accidentPeopleMedia,
            'accidentCar' => $accidentCar,
            'accidentCarMedias' => $accidentCarMedia
        ]);
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
        $accident = Accident::where('acc_id', $id)->first();
        $accident->staff_id = Auth::id();
        $accident->our_truck_speed = $request->ourTruckSpeed;
        $accident->our_truck_repair_garage_addr = $request->ourTruckRepairGarageAddress;
        $accident->our_truck_repair_garage_tel = $request->ourTruckRepairGarageTel;
        $accident->onsite_road_type = $request->roadType;
        $accident->onsite_road_width = $request->roadWidth;
        $accident->onsite_outlook = $request->outlook;
        $accident->onsite_traffic_signs = $request->trafficSign;
        $accident->acc_date = $request->date;
        $accident->acc_time = $request->time;
        $accident->onsite_collision_point = $request->collisionPoint;
        $accident->onsite_park_position = $request->parkPosition;
        $accident->onsite_victim = $request->victim;
        $accident->onsite_witness = $request->witness;
        $accident->acc_content = $request->content;
        switch ($request->input('action')) {
            case 'draft':
                $accident->acc_status = 1;
                break;
            case 'report':
                $accident->acc_status = 2;
                break;
        }
        $accident->save();
        //Xử lý Insurance Image tải lên
        if ($request->hasFile('accidentImage')) {
            $allowedfileExtension = ['jpg', 'jpeg', 'png', 'bmp'];
            $files = $request->file('accidentImage');
            foreach ($files as $file) {
                //$filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $check = in_array($extension, $allowedfileExtension);
                if ($check) {
                    $path = $file->store('public/File');
                    $path = substr($path, strlen('public/'));
                    $accidentMedia = new AccidentMedia();
                    $accidentMedia->acc_media_url = $path;
                    $accidentMedia->acc_id = $accident->acc_id;
                    $accidentMedia->insert_date = Carbon::now();
                    $accidentMedia->save();
                }
            }
        }


        $accidentPeople = AccidentPeople::where('acc_id', $accident->acc_id)->first();
        $accidentPeople->acc_involved_people_name = $request->peopleName;
        $accidentPeople->acc_involved_people_addr = $request->peopleAddress;
        $accidentPeople->acc_involved_people_contact = $request->peopleContact;
        $accidentPeople->acc_involved_people_tel = $request->peopleTelephone;
        $accidentPeople->acc_involved_people_company = $request->peopleCompany;
        $accidentPeople->acc_involved_people_other = $request->otherPeopleName;
        $accidentPeople->acc_involved_people_other_contact = $request->otherPeopleContact;
        $accidentPeople->acc_involved_people_insurance_company = $request->insuranceCompanyName;
        $accidentPeople->acc_involved_people_insurance_number = $request->insuranceNumber;
        $accidentPeople->last_update_date = Carbon::now();
        $accidentPeople->save();
        //Xử lý Insurance Image tải lên
        if ($request->hasFile('carImage')) {
            $allowedfileExtension = ['jpg', 'jpeg', 'png', 'bmp'];
            $files = $request->file('insuranceImage');
            foreach ($files as $file) {
                //$filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $check = in_array($extension, $allowedfileExtension);
                if ($check) {
                    $path = $file->store('public/File');
                    $path = substr($path, strlen('public/'));
                    $accidentPeopleMedia = new AccidentPeopleMedia;
                    $accidentPeopleMedia->insurance_media_url = $path;
                    $accidentPeopleMedia->acc_involved_people_id = $accidentPeople->acc_involved_people_id;
                    $accidentPeopleMedia->insert_date = Carbon::now();
                    $accidentPeopleMedia->save();
                }
            }
        }

        $accidentCar = AccidentCar::where('acc_involved_people_id', $accidentPeople->acc_involved_people_id)->first();
        $accidentCar->car_number_palette = $request->carNumberPalette;
        $accidentCar->car_type = $request->carType;
        $accidentCar->car_color = $request->carColor;
        $accidentCar->car_speed = $request->carSpeed;
        $accidentCar->car_repair_garage = $request->carRepairGarageAddress;
        $accidentCar->car_repair_garage_tel = $request->carRepairGarageTel;
        $accidentCar->last_update_date = Carbon::now();
        $accidentCar->save();
        //Xử lý Car Image tải lên
        if ($request->hasFile('carImage')) {
            $allowedfileExtension = ['jpg', 'jpeg', 'png', 'bmp'];
            $files = $request->file('carImage');
            foreach ($files as $file) {
                //$filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $check = in_array($extension, $allowedfileExtension);
                if ($check) {
                    $path = $file->store('public/File');
                    $path = substr($path, strlen('public/'));
                    $accidentCarMedia = new AccidentCarMedia();
                    $accidentCarMedia->car_media_url = $path;
                    $accidentCarMedia->involved_car_id = $accidentCar->involved_car_id;
                    $accidentCarMedia->insert_date = Carbon::now();
                    $accidentCarMedia->save();
                }
            }
        }

        if (Auth::user()->roleId != 3) return redirect()->route('accident.show', ['id' => $accident->acc_id]);
        else return redirect()->route('staff.accident.show', ['id' => $accident->acc_id]);
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


    public function deleteCarImage($id)
    {
        $accidentCarMedia = AccidentCarMedia::where('car_media_id', $id)->first();
        $accidentCarMedia->delete();
        return back();
    }


    public function deleteInsuranceImage($id)
    {
        $accidentPeopleMedia = AccidentPeopleMedia::where('insurance_media_id', $id)->first();
        $accidentPeopleMedia->delete();
        return back();
    }


    public function deleteAccidentImage($id)
    {
        $accidentMedia = AccidentMedia::where('acc_media_id', $id)->first();
        $accidentMedia->delete();
        return back();
    }


    public function search(Request $request)
    {
        if (Auth::user()->roleId != 3) {
            $accident = Accident::where('acc_date', $request->date)->get();
        } else {
            $accident = Accident::where('acc_date', $request->date)
                ->where('staff_id', Auth::id())
                ->get();
        }

        if (Auth::user()->roleId != 3) return view('admin.accident.result', ['accidents' => $accident, 'date' => $request->date]);
        else return view('staff.accident.result', ['accidents' => $accident, 'date' => $request->date]);
    }


    public function report($id)
    {
        $accident = Accident::where('acc_id', $id)->first();
        $accident->acc_status = 2;
        $accident->save();

        if (Auth::user()->roleId != 3) return redirect()->route('accident.show', ['id' => $accident->acc_id]);
        else return redirect()->route('staff.accident.show', ['id' => $accident->acc_id]);
    }
}
