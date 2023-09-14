<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Service::get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('logo', function ($row) {
                    $logo = '<img src="' . asset('/') . $row->logo . '" alt="image" width="50" height="50">';
                    return $logo;
                })
                ->addColumn('detail_image', function ($row) {
                    $image = '<img src="' . asset('/') . $row->detail_image . '" alt="image" width="50" height="50">';
                    return $image;
                })
                ->addColumn('description', function ($row) {
                    $description = '<textarea class="form-control" disabled="" style="width:180px; display:inline;">'.$row->description_en.'</textarea>';
                    return $description;
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
                    $btn = '<button class="modal-effect btn btn-sm btn-info"  style="margin: 5px" id="showModalEditService" data-id="' . $row->id . '"><i class="las la-pen"></i></button>';
                    $btn = $btn . '<button class="modal-effect btn btn-sm btn-danger" id="showModalDeleteService" data-name="' . $row->title_en . '" data-id="' . $row->id . '"><i class="las la-trash"></i></button>';
                    return $btn;
                })
                ->rawColumns([
                    'logo' => 'logo',
                    'detail_image' => 'detail_image',
                    'description' => 'description',
                    'status' => 'status',
                    'action' => 'action',
                ])
                ->make(true);
        }
        return view('dashboard.views-dash.service.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $serviceData = $request->all();
        $validator = Validator($serviceData, [
            'title_en' => 'required|string|min:3|max:255',
            'description_en' => 'required|string|min:3',
            'logo' => 'required|image',
            'detail_image' => 'required|image',
            'status' => 'required|in:ACTIVE,NACTIVE',
        ]);
        if (!$validator->fails()) {
            if ($request->hasFile('logo')) {
                $name = Str::random(12);
                $logo = $request->file('logo');
                $logoName = $name . time() . '_' . '.' . $logo->getClientOriginalExtension();
                $logo->move(public_path('image'), $logoName);
                $serviceData['logo'] = 'image/' . $logoName;
            }
            if ($request->hasFile('detail_image')) {
                $name = Str::random(12);
                $image = $request->file('detail_image');
                $imageName = $name . time() . '_' . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('image') , $imageName);
                $serviceData['detail_image'] = 'image/' . $imageName;
            }
            $service = Service::create($serviceData);
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
        $service = Service::find($id);
        if($service){
            $response = [
                'message' => 'Found Data',
                'status' => 200,
                'data' => $service
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
        $serviceData = $request->all();
        $validator = Validator($serviceData, [
            'title_en' => 'required|string|min:3|max:255',
            'description_en' => 'required|string|min:3',
            'logo' => 'nullable|image',
            'detail_image' => 'nullable|image',
            'status' => 'required|in:ACTIVE,NACTIVE',
        ]);
        if (!$validator->fails()) {
            if ($request->hasFile('logo')) {
                $name = Str::random(12);
                $logo = $request->file('logo');
                $logoName = $name . time() . '_' . '.' . $logo->getClientOriginalExtension();
                $logo->move(public_path('image'), $logoName);
                $serviceData['logo'] = 'image/' . $logoName;
            }
            if ($request->hasFile('detail_image')) {
                $name = Str::random(12);
                $image = $request->file('detail_image');
                $imageName = $name . time() . '_' . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('image') , $imageName);
                $serviceData['detail_image'] = 'image/' . $imageName;
            }
            $service = Service::find($id)->update($serviceData);
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = Service::find($id);
        if($service){
            $service->delete();
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
        $service = Service::find($id);
        if($service){
            $service->changeStatus();
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
