<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ExperiencesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Experience::get();
            return DataTables::of($data)
                ->addIndexColumn()
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
                    $btn = '<button class="modal-effect btn btn-sm btn-info"  style="margin: 5px" id="showModalEditExperience" data-id="' . $row->id . '"><i class="las la-pen"></i></button>';
                    $btn = $btn . '<button class="modal-effect btn btn-sm btn-danger" id="showModalDeleteExperience" data-name="' . $row->title_en . '" data-id="' . $row->id . '"><i class="las la-trash"></i></button>';
                    return $btn;
                })
                ->rawColumns([
                    'description' => 'description',
                    'status' => 'status',
                    'action' => 'action',
                ])
                ->make(true);
        }
        return view('dashboard.views-dash.experience.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $experienceData = $request->all();
        $validator = Validator($experienceData, [
            'title_en' => 'required|string|min:3|max:255',
            'Learn_resource_en' => 'required|string|min:3|max:255',
            'description_en' => 'required|string|min:3|max:255',
            'year_range' => 'required|string|min:3|max:255',
        ]);
        if (!$validator->fails()) {
            $experience = Experience::create($experienceData);
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
        $experience = Experience::find($id);
        if($experience){
            $response = [
                'message' => 'Found Data',
                'status' => 200,
                'data' => $experience
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
        $experienceData = $request->all();
        $validator = Validator($experienceData, [
            'title_en' => 'required|string|min:3|max:255',
            'Learn_resource_en' => 'required|string|min:3|max:255',
            'description_en' => 'required|string|min:3|max:255',
            'year_range' => 'required|string|min:3|max:255',
        ]);
        if (!$validator->fails()) {
            $experience = Experience::find($id)->update($experienceData);
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
        $experience = Experience::find($id);
        if($experience){
            $experience->delete();
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
        $experience = Experience::find($id);
        if($experience){
            $experience->changeStatus();
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
