<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
class BusinessesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $category_id = $request->category;
        $categories = Category::get();
        if ($request->ajax()) {
            $data = Business::with('category')->when($category_id , function ($q) use ($category_id){
                $q->where('category_id' , $category_id);
            })->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('logo', function ($row) {
                    $logo = '<img src="' . asset('/') . $row->logo . '" alt="image" width="50" height="50">';
                    return $logo;
                })
                ->addColumn('image', function ($row) {
                    $image = '<img src="' . asset('/') . $row->image . '" alt="image" width="50" height="50">';
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
                    $btn = '<button class="modal-effect btn btn-sm btn-info"  style="margin: 5px" id="showModalEditBusiness" data-id="' . $row->id . '"><i class="las la-pen"></i></button>';
                    $btn = $btn . '<button class="modal-effect btn btn-sm btn-danger" id="showModalDeleteBusiness" data-name="' . $row->title_en . '" data-id="' . $row->id . '"><i class="las la-trash"></i></button>';
                    return $btn;
                })
                ->rawColumns([
                    'logo' => 'logo',
                    'image' => 'image',
                    'status' => 'status',
                    'action' => 'action',
                ])
                ->make(true);
        }
        return view('dashboard.views-dash.business.index' , compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $businessData = $request->all();
        $validator = Validator($businessData, [
            'title_en' => 'required|string|min:3|max:255',
            'link' => 'required|string|min:3|max:255',
            'sub_title_en' => 'required|string|min:3|max:255',
            'category_id' => 'required|exists:categories,id',
            'logo' => 'required|image',
            'image' => 'required|image',
            'status' => 'required|in:ACTIVE,NACTIVE',
        ]);
        if (!$validator->fails()) {
            if ($request->hasFile('logo')) {
                $name = Str::random(12);
                $logo = $request->file('logo');
                $logoName = $name . time() . '_' . '.' . $logo->getClientOriginalExtension();
                $logo->move(public_path('image'), $logoName);
                $businessData['logo'] = 'image/' . $logoName;
            }
            if ($request->hasFile('image')) {
                $name = Str::random(12);
                $image = $request->file('image');
                $imageName = $name . time() . '_' . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('image') , $imageName);
                $businessData['image'] = 'image/' . $imageName;
            }
            $business = Business::create($businessData);
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
        $business = Business::find($id);
        if($business){
            $response = [
                'message' => 'Found Data',
                'status' => 200,
                'data' => $business
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
        $businessData = $request->all();
        $validator = Validator($businessData, [
            'title_en' => 'required|string|min:3|max:255',
            'link' => 'required|string|min:3|max:255',
            'sub_title_en' => 'required|string|min:3|max:255',
            'category_id' => 'required|exists:categories,id',
            'logo' => 'nullable|image',
            'image' => 'nullable|image',
            'status' => 'required|in:ACTIVE,NACTIVE',
        ]);
        if (!$validator->fails()) {
            if ($request->hasFile('logo')) {
                $name = Str::random(12);
                $logo = $request->file('logo');
                $logoName = $name . time() . '_' . '.' . $logo->getClientOriginalExtension();
                $logo->move(public_path('image'), $logoName);
                $businessData['logo'] = 'image/' . $logoName;
            }
            if ($request->hasFile('image')) {
                $name = Str::random(12);
                $image = $request->file('image');
                $imageName = $name . time() . '_' . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('image') , $imageName);
                $businessData['image'] = 'image/' . $imageName;
            }
            $business = Business::find($id)->update($businessData);
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
        $business = Business::find($id);
        if($business){
            $business->delete();
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
        $business = Business::find($id);
        if($business){
            $business->changeStatus();
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
