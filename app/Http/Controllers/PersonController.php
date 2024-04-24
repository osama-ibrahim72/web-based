<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePersonRequest;
use App\Http\Requests\UpdatePersonRequest;
use App\Http\Resources\PersonResource;
use App\Models\Person;
use App\Scoping\Scopes\FilterByNationalIDScope;
use http\Env\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PersonController extends Controller
{
    /**
     * @param StorePersonRequest $request
     * @return PersonResource|JsonResponse
     */
    public function store(
        StorePersonRequest $request
    ):PersonResource|JsonResponse
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

    /**
     * @param UpdatePersonRequest $request
     * @param Person $person
     * @return PersonResource|JsonResponse
     */
    public function update(
        UpdatePersonRequest $request,
        Person $person
    ):PersonResource|JsonResponse
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

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return PersonResource::collection(
            Person::withScopes($this->scopes())->get()
        )->additional([
            'message' => null,
            'status' => 200
        ]);
    }

    /**
     * @return array
     */
    private function scopes():array
    {
        return [
            'nationalityID' => new FilterByNationalIDScope(),
        ];
    }
}
