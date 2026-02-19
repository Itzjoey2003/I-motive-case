<?php

namespace App\http\Controllers\API\V1;

use App\Models\Lead;
use App\Http\Requests\StoreLeadRequest;
use App\Http\Requests\UpdateLeadRequest;
use App\http\Controllers\Controller;
use App\http\Resources\V1\LeadResource;
use App\http\Resources\V1\LeadCollection;
use Symfony\Component\HttpFoundation\Request;
use App\Filter\V1\LeadsFilter;
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
        if (count($queryItems) == 0) {
            return new LeadCollection(Lead::paginate());
        } else {
            return new LeadCollection(Lead::where($queryItems)->paginate());
        }

        Lead::where($queryItems);
        
    
    
    
    return new LeadCollection(Lead::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLeadRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Lead $lead)
    {
      return new LeadResource($lead);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lead $lead)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLeadRequest $request, Lead $lead)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lead $lead)
    {
        //
    }
}
