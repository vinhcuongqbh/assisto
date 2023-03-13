<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Accident;
use App\Models\AccidentMedia;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;




class AccidentController extends Controller
{
    public function index()
    {
        if (Auth::user()->roleId != 3) {
            $accident = Accident::where('acc_status', 2)
                ->leftjoin('moz_users', 'moz_users.id', 'asahi_accident_report.staff_id')
                ->leftjoin('asahi_center', 'asahi_center.centerId', 'moz_users.centerId')
                ->leftjoin('asahi_track_report_status', 'asahi_track_report_status.track_status_id', 'asahi_accident_report.acc_status')
                ->select('asahi_accident_report.*', 'moz_users.userId', 'moz_users.name', 'asahi_center.centerName', 'asahi_track_report_status.track_status_name')
                ->orderBy('asahi_accident_report.acc_date', 'desc')
                ->get();
            return view('admin.accident.index', ['accidents' => $accident]);
        } else {
            $accident = Accident::where('staff_id', Auth::id())
                ->join('asahi_track_report_status', 'asahi_track_report_status.track_status_id', 'asahi_accident_report.acc_status')
                ->select('asahi_accident_report.*', 'asahi_track_report_status.track_status_name')
                ->orderBy('asahi_accident_report.acc_date', 'desc')
                ->get();
            return view('staff.accident.index', ['accidents' => $accident]);
        }
    }



    public function check()
    {
        if (Auth::user()->roleId != 3) return view('admin.accident.check');
        else return view('staff.accident.check');
    }



    public function create()
    {
        if (Auth::user()->roleId != 3) return view('admin.accident.create');
        else return view('staff.accident.create');
    }



    public function store(Request $request)
    {
        //Kiểm tra thông tin đầu vào
        $validated = $request->validate([
            'date' => 'required'
        ]);

        $accident = new Accident;
        $accident->staff_id = Auth::id();
        $accident->acc_date = $request->date;
        $accident->acc_time = $request->time;
        $accident->acc_coordinates = $request->lat_pos.",".$request->long_pos;
        $accident->acc_involved_people_name = $request->peopleName;
        $accident->acc_involved_people_addr = $request->peopleAddress;
        $accident->acc_involved_people_tel = $request->peopleTelephone;
        $accident->acc_involved_people_company = $request->peopleCompany;
        $accident->acc_involved_people_company_contact = $request->companyContact;
        $accident->acc_involved_people_person_in_charge = $request->personInCharge;
        $accident->acc_involved_people_car_plates = $request->carPlates;
        $accident->acc_involved_people_insurance_company = $request->insuranceCompanyName;
        $accident->acc_involved_people_insurance_company_contact = $request->insuranceCompanyContact;
        switch ($request->input('action')) {
            case 'draft':
                $accident->acc_status = 1;
                break;
            case 'report':
                $accident->acc_status = 2;
                break;
        }
        $accident->save();

        //Xử lý Ảnh tải lên
        if ($request->hasFile('frontVictimCar')) $this->uploadImage($request->file('frontVictimCar'), 1, 1, $accident->acc_id);
        if ($request->hasFile('fullVictimCar')) $this->uploadImage($request->file('fullVictimCar'), 1, 2, $accident->acc_id);
        if ($request->hasFile('victimDamagePart')) $this->uploadImage($request->file('victimDamagePart'), 1, 3, $accident->acc_id);
        if ($request->hasFile('victimAddImage')) {
            foreach ($request->file('victimAddImage') as $victimAddImage) {
                $this->uploadImage($victimAddImage, 1, 4, $accident->acc_id);
            }
        }
        if ($request->hasFile('frontCar')) $this->uploadImage($request->file('frontCar'), 0, 1, $accident->acc_id);
        if ($request->hasFile('fullCar')) $this->uploadImage($request->file('fullCar'), 0, 2, $accident->acc_id);
        if ($request->hasFile('damagePart')) $this->uploadImage($request->file('damagePart'), 0, 3, $accident->acc_id);
        if ($request->hasFile('addImage')) {
            foreach ($request->file('addImage') as $addImage) {
                $this->uploadImage($addImage, 0, 4, $accident->acc_id);
            }
        }

        if (Auth::user()->roleId != 3) return redirect()->route('accident.show', ['id' => $accident->acc_id]);
        else return redirect()->route('staff.accident.show', ['id' => $accident->acc_id]);
    }



    public function show($id)
    {
        $accident = Accident::where('asahi_accident_report.acc_id', $id)
            ->leftjoin('asahi_track_report_status', 'asahi_track_report_status.track_status_id', 'asahi_accident_report.acc_status')
            ->select('asahi_accident_report.*', 'asahi_track_report_status.track_status_name')
            ->first();

        $accidentMedia = AccidentMedia::where('acc_id', $accident->acc_id)->get();

        if (Auth::user()->roleId != 3) return view('admin.accident.show', [
            'accident' => $accident,
            'accidentMedias' => $accidentMedia,
        ]);
        else return view('staff.accident.show', [
            'accident' => $accident,
            'accidentMedias' => $accidentMedia,
        ]);
    }



    public function edit($id)
    {
        $accident = Accident::where('asahi_accident_report.acc_id', $id)
            ->leftjoin('asahi_track_report_status', 'asahi_track_report_status.track_status_id', 'asahi_accident_report.acc_status')
            ->select('asahi_accident_report.*', 'asahi_track_report_status.track_status_name')
            ->first();

        $accidentMedia = AccidentMedia::where('acc_id', $accident->acc_id)->get();


        if (Auth::user()->roleId != 3) return view('admin.accident.edit', [
            'accident' => $accident,
            'accidentMedias' => $accidentMedia,
        ]);
        else return view('staff.accident.edit', [
            'accident' => $accident,
            'accidentMedias' => $accidentMedia,
        ]);
    }



    public function update(Request $request, $id)
    {
        //Kiểm tra thông tin đầu vào
        $validated = $request->validate([
            'date' => 'required'
        ]);


        $accident = Accident::where('acc_id', $id)->first();
        $accident->acc_date = $request->date;
        $accident->acc_time = $request->time;
        $accident->acc_involved_people_name = $request->peopleName;
        $accident->acc_involved_people_addr = $request->peopleAddress;
        $accident->acc_involved_people_tel = $request->peopleTelephone;
        $accident->acc_involved_people_company = $request->peopleCompany;
        $accident->acc_involved_people_company_contact = $request->companyContact;
        $accident->acc_involved_people_person_in_charge = $request->personInCharge;
        $accident->acc_involved_people_car_plates = $request->carPlates;
        $accident->acc_involved_people_insurance_company = $request->insuranceCompanyName;
        $accident->acc_involved_people_insurance_company_contact = $request->insuranceCompanyContact;
        switch ($request->input('action')) {
            case 'draft':
                $accident->acc_status = 1;
                break;
            case 'report':
                $accident->acc_status = 2;
                break;
        }
        $accident->save();

        //Xử lý Ảnh tải lên
        if ($request->hasFile('frontVictimCar')) $this->uploadImage($request->file('frontVictimCar'), 1, 1, $accident->acc_id);
        if ($request->hasFile('fullVictimCar')) $this->uploadImage($request->file('fullVictimCar'), 1, 2, $accident->acc_id);
        if ($request->hasFile('victimDamagePart')) $this->uploadImage($request->file('victimDamagePart'), 1, 3, $accident->acc_id);
        if ($request->hasFile('victimAddImage')) {
            foreach ($request->file('victimAddImage') as $victimAddImage) {
                $this->uploadImage($victimAddImage, 1, 4, $accident->acc_id);
            }
        }
        if ($request->hasFile('frontCar')) $this->uploadImage($request->file('frontCar'), 0, 1, $accident->acc_id);
        if ($request->hasFile('fullCar')) $this->uploadImage($request->file('fullCar'), 0, 2, $accident->acc_id);
        if ($request->hasFile('damagePart')) $this->uploadImage($request->file('damagePart'), 0, 3, $accident->acc_id);
        if ($request->hasFile('addImage')) {
            foreach ($request->file('addImage') as $addImage) {
                $this->uploadImage($addImage, 0, 4, $accident->acc_id);
            }
        }

        if (Auth::user()->roleId != 3) return redirect()->route('accident.show', ['id' => $accident->acc_id]);
        else return redirect()->route('staff.accident.show', ['id' => $accident->acc_id]);
    }


    public function destroy($id)
    {
        //Xóa ảnh thuộc Accident Report
        $accidentMedia = AccidentMedia::where('acc_id', $id)->get();
        foreach ($accidentMedia as $i) {
            if (Storage::exists('public/' . $i->acc_media_url)) {
                Storage::delete('public/' . $i->acc_media_url);
            }
            $i->delete();
        }

        //Xóa Accident Report
        $accident = Accident::where('acc_id', $id)->first();
        $accident->delete();

        if (Auth::user()->roleId != 3) return redirect()->route('accident');
        else return redirect()->route('staff.accident.index');
    }

    public function deleteImage($id)
    {
        //Xóa ảnh thuộc Accident Report
        $accidentMedia = AccidentMedia::where('acc_media_id', $id)->first();
        if (Storage::exists('public/' . $accidentMedia->acc_media_url)) {
            Storage::delete('public/' . $accidentMedia->acc_media_url);
        }
        $accidentMedia->delete();
        return back();
    }



    public function search(Request $request)
    {
        if (Auth::user()->roleId != 3) {
            $accident = Accident::where('acc_date', $request->date)
                ->join('asahi_track_report_status', 'asahi_track_report_status.track_status_id', 'asahi_accident_report.acc_status')
                ->select('asahi_accident_report.*', 'asahi_track_report_status.track_status_name')
                ->orderBy('asahi_accident_report.acc_date', 'desc')
                ->get();
            return view('admin.accident.result', ['accidents' => $accident, 'date' => $request->date]);
        } else {
            $accident = Accident::where('acc_date', $request->date)
                ->where('staff_id', Auth::id())
                ->join('asahi_track_report_status', 'asahi_track_report_status.track_status_id', 'asahi_accident_report.acc_status')
                ->select('asahi_accident_report.*', 'asahi_track_report_status.track_status_name')
                ->orderBy('asahi_accident_report.acc_date', 'desc')
                ->get();
            return view('staff.accident.result', ['accidents' => $accident, 'date' => $request->date]);
        }
    }

    public function report($id)
    {
        $accident = Accident::where('acc_id', $id)->first();
        $accident->acc_status = 2;
        $accident->save();

        if (Auth::user()->roleId != 3) return redirect()->route('accident.show', ['id' => $accident->acc_id]);
        else return redirect()->route('staff.accident.show', ['id' => $accident->acc_id]);
    }


    //Hàm Upload Ảnh
    public function uploadImage($image, $owner, $type, $acc_id)
    {
        $allowedfileExtension = ['jpg', 'jpeg', 'png', 'bmp'];
        //$filename = $file->getClientOriginalName();
        $extension = $image->getClientOriginalExtension();
        $check = in_array($extension, $allowedfileExtension);
        if ($check) {
            $imgName = Auth::user()->id.uniqid();     
            $img = Image::make($image->path());      
            $img->resize(2000, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save('../public/storage/File/'.$imgName.'.'.$extension);

            //$path = $image->store('public/File');
            $path = "File/".$imgName.".".$extension;
            $accidentMedia = new AccidentMedia();
            $accidentMedia->acc_media_url = $path;
            $accidentMedia->acc_media_owner = $owner;
            $accidentMedia->acc_media_type = $type;
            $accidentMedia->acc_id = $acc_id;
            $accidentMedia->insert_date = Carbon::now();
            $accidentMedia->save();
        }
    }
}