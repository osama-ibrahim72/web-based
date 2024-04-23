<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePersonRequest;
use App\Http\Requests\UpdatePersonRequest;
use App\Http\Resources\PersonResource;
use App\Models\Person;
use http\Env\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PersonController extends Controller
{
    public function store(
        StorePersonRequest $request
    )
    {
       if($person = Person::create($request->validated())) {
           return PersonResource::make(
               $person
           )->additional([
               'message' => __('Person Created Successfully'),
               'status' => 201
           ]);
       }
       return response()->json([
           'message'=> __('Can\'t store this person'),
            'status'=>403,
       ]);
    }

    public function update(
        UpdatePersonRequest $request,
        Person $person
    )
    {
        if($person->update($request->validated())) {
            return PersonResource::make(
                $person
            )->additional([
                'message' => __('Person Updated Successfully'),
                'status' => 200
            ]);
        }
        return response()->json([
            'message'=> __('Can\'t store this person'),
            'status'=>403,
        ]);
    }
}
