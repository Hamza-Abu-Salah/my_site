<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Contact::get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('message', function ($row) {
                    $message = '<textarea class="form-control" disabled="" style="width:180px; display:inline;">'.$row->message.'</textarea>';
                    return $message;
                })
                ->addColumn('action', function ($row) {
                    // $btn = '<button class="modal-effect btn btn-sm btn-info"  style="margin: 5px" id="showModalEditContact" data-id="' . $row->id . '"><i class="las la-pen"></i></button>';
                    $btn = '<button class="modal-effect btn btn-sm btn-danger" id="showModalDeleteContact" data-name="' . $row->name . '" data-id="' . $row->id . '"><i class="las la-trash"></i></button>';
                    return $btn;
                })
                ->rawColumns([
                    'message' => 'message',
                    'action' => 'action',
                ])
                ->make(true);
        }
        return view('dashboard.views-dash.contact.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact = Contact::find($id);
        if($contact){
            $contact->delete();
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
}
