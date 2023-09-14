<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
class AboutsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = About::get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('first_photo', function ($row) {
                    $image = '<img src="' . asset('/') . $row->first_photo . '" alt="image" width="50" height="50">';
                    return $image;
                })
                ->addColumn('second_photo', function ($row) {
                    $image = '<img src="' . asset('/') . $row->second_photo . '" alt="image" width="50" height="50">';
                    return $image;
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == 'ACTIVE') {
                        $status = '<button class="modal-effect btn btn-sm btn-success" style="margin: 5px" id="status" data-id="' . $row->id . '" ><i class=" icon-check"></i></button>';
                    } else {
                        $status = '<button class="modal-effect btn btn-sm btn-danger" style="margin: 5px" id="status" data-id="' . $row->id . '" ><i class=" icon-check"></i></button>';
                    }
                    return $status;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<button class="modal-effect btn btn-sm btn-info"  style="margin: 5px" id="showModalEditAboutMe" data-id="' . $row->id . '"><i class="las la-pen"></i></button>';
                    $btn = $btn . '<button class="modal-effect btn btn-sm btn-danger" id="showModalDeleteAboutMe" data-name="' . $row->name_en . '" data-id="' . $row->id . '"><i class="las la-trash"></i></button>';
                    return $btn;
                })
                ->rawColumns([
                    'first_photo' => 'first_photo',
                    'second_photo' => 'second_photo',
                    'status' => 'status',
                    'action' => 'action',
                ])
                ->make(true);
        }
        return view('dashboard.views-dash.about.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $aboutData = $request->all();
        $validator = Validator($aboutData, [
            'name_en' => 'required|string|min:3|max:255',
            'Birthday' => 'required|date_format:Y-m-d',
            'Mail' => 'required|email',
            'Phone' => 'required',
            'Address_en' => 'required|string|min:3|max:255',
            'Nationality_en' => 'required|string|min:3|max:255',
            'job_title_en' => 'required|string|min:3|max:255',
            'job_description_en' => 'required|string|min:3|max:255',
            'about_en' => 'required|string|min:3',
            'status' => 'required|in:ACTIVE,NACTIVE',
            'cv' => 'required|mimes:pdf',
            'first_photo' => 'required|image',
            'second_photo' => 'required|image',
        ]);
        if (!$validator->fails()) {
            if ($request->hasFile('first_photo')) {
                $name = Str::random(12);
                $firstPhoto = $request->file('first_photo');
                $firstPhotoName = $name . time() . '_' . '.' . $firstPhoto->getClientOriginalExtension();
                $firstPhoto->move(public_path('image'), $firstPhotoName);
                $aboutData['first_photo'] = 'image/' . $firstPhotoName;
            }
            if ($request->hasFile('second_photo')) {
                $name = Str::random(12);
                $secondPhoto = $request->file('second_photo');
                $secondPhotoName = $name . time() . '_' . '.' . $secondPhoto->getClientOriginalExtension();
                $secondPhoto->move(public_path('image') , $secondPhotoName);
                $aboutData['second_photo'] = 'image/' . $secondPhotoName;
            }
            if ($request->hasFile('cv')) {
                $name = Str::random(12);
                $cv = $request->file('cv');
                $cvName = $name . time() . '_' . '.' . $cv->getClientOriginalExtension();
                $cv->move(public_path('cv'), $cvName);
                $aboutData['cv'] = 'cv/' . $cvName;
            }
            $about = About::create($aboutData);
                $response = [
                    'message' => 'Added successfully',
                    'status' => 200,
                ];
                return ControllersService::responseSuccess($response);
        } else {
            $response = [
                'message' => $validator->getMessageBag()->first(),
                'status' => 400,
            ];
            return ControllersService::responseErorr($response);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $about = About::find($id);
        if($about){
            $response = [
                'message' => 'Found Data',
                'status' => 200,
                'data' => $about
            ];
            return ControllersService::responseSuccess($response);
        }else{
            $response = [
                'message' => 'Not Found Data',
                'status' => 400,
            ];
            return ControllersService::responseErorr($response);
        }
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
        $aboutData = $request->all();
        $validator = Validator($aboutData, [
            'name_en' => 'required|string|min:3|max:255',
            'Birthday' => 'required|date_format:Y-m-d',
            'Mail' => 'required|email',
            'Phone' => 'required',
            'Address_en' => 'required|string|min:3|max:255',
            'Nationality_en' => 'required|string|min:3|max:255',
            'job_title_en' => 'required|string|min:3|max:255',
            'job_description_en' => 'required|string|min:3|max:255',
            'about_en' => 'required|string|min:3',
            'status' => 'required|in:ACTIVE,NACTIVE',
            'cv' => 'nullable|mimes:pdf',
            'first_photo' => 'nullable|image',
            'second_photo' => 'nullable|image',
        ]);
        if (!$validator->fails()) {
            if ($request->hasFile('first_photo')) {
                $name = Str::random(12);
                $firstPhoto = $request->file('first_photo');
                $firstPhotoName = $name . time() . '_' . '.' . $firstPhoto->getClientOriginalExtension();
                $firstPhoto->move(public_path('image'), $firstPhotoName);
                $aboutData['first_photo'] = 'image/' . $firstPhotoName;
            }
            if ($request->hasFile('second_photo')) {
                $name = Str::random(12);
                $secondPhoto = $request->file('second_photo');
                $secondPhotoName = $name . time() . '_' . '.' . $secondPhoto->getClientOriginalExtension();
                $secondPhoto->move(public_path('image') , $secondPhotoName);
                $aboutData['second_photo'] = 'image/' . $secondPhotoName;
            }
            if ($request->hasFile('cv')) {
                $name = Str::random(12);
                $cv = $request->file('cv');
                $cvName = $name . time() . '_' . '.' . $cv->getClientOriginalExtension();
                $cv->move(public_path('cv'), $cvName);
                $aboutData['cv'] = 'cv/' . $cvName;
            }
            $about = About::find($id)->update($aboutData);
                $response = [
                    'message' => 'Updated successfully',
                    'status' => 200,
                ];
                return ControllersService::responseSuccess($response);
        } else {
            $response = [
                'message' => $validator->getMessageBag()->first(),
                'status' => 400,
            ];
            return ControllersService::responseErorr($response);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $about = About::find($id);
        if($about){
            $about->delete();
            $response = [
                'message' => 'Deleted successfully',
                'status' => 200,
            ];
            return ControllersService::responseSuccess($response);
        }else{
            $response = [
                'message' => 'Not Found Data',
                'status' => 400,
            ];
            return ControllersService::responseErorr($response);
        }
    }

    public function status($id)
    {
        $about = About::find($id);
        if($about){
            $about->changeStatus();
            $response = [
                'message' => 'Updated successfully',
                'status' => 200,
            ];
            return ControllersService::responseSuccess($response);
        }else{
            $response = [
                'message' => 'Not Found Data',
                'status' => 400,
            ];
            return ControllersService::responseErorr($response);
        }
    }
}
