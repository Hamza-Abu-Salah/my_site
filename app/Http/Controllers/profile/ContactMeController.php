<?php

namespace App\Http\Controllers\profile;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ControllersService;
use App\Http\Middleware\VerifyCsrfToken;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactMeController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $contactData = $request->all();

        $validator = Validator($contactData, [
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|string|min:3|max:255',
            'phone' => 'required|string|min:3|max:255',
            'subject' => 'required|string|min:3|max:255',
            'message' => 'required|string',
        ]);
        if (!$validator->fails()) {
            $contact = Contact::create($contactData);
                $response = [
                    'message' => 'Added successfully',
                    'status' => 200,
                ];
                return ControllersService::responseSuccess("");
        } else {
            $response = [
                'message' => $validator->getMessageBag()->first(),
                'status' => 400,
            ];
            return ControllersService::responseErorr($response);
        }
    }
}
