<?php

namespace App\http\Controllers\API\V1;

use App\Models\Lead;
use App\http\Controllers\Controller;
use App\http\Resources\V1\LeadResource;
use App\http\Resources\V1\LeadCollection;
use Illuminate\Http\Request;
use App\Filter\V1\LeadsFilter;
use App\Http\Requests\V1\StoreLeadRequest;
use App\Http\Requests\V1\UpdateLeadRequest;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new LeadsFilter();
        $queryItems = $filter->Transform($request); // [['column', 'operator', 'value']]

        // if no filters apply, show everything
        // Most recent updated at gets filtered to the top
        if (count($queryItems) == 0) {
            return new LeadCollection(Lead::orderBy('updated_at', 'desc')->get());
        } else {
            $leads = Lead::where($queryItems)->orderBy('updated_at', 'desc')->get();
            return new LeadCollection(Lead::where($queryItems)->orderBy('updated_at', 'desc')->get()); //adds the filter to links
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLeadRequest $request)
    {
        return new LeadResource(Lead::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Lead $lead)
    {
      return new LeadResource($lead);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLeadRequest $request, Lead $lead)
    {
        $lead->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lead $lead)
    {
        $lead->destroy($lead->all());

    }
}
