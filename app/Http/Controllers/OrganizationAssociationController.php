<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrganizationAssociationRequest;
use App\Models\Organization;
use Illuminate\Http\Request;

class OrganizationAssociationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.org-association.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrganizationAssociationRequest $request)
    {
        auth()->user()->orgAssociation()->create([
            'name' => $request->name,
            'associated_as' => $request->associated_as,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'description' => $request->description,
        ]);

        return redirect()->route('dashboard')->with('success-org', 'Organization Association added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Organization $organization)
    {
        return view('user.org-association.edit', [
            'organization' => $organization
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(OrganizationAssociationRequest $request, Organization $organization)
    {
        $organization->update([
            'name' => $request->name,
            'associated_as' => $request->associated_as,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'description' => $request->description,
        ]);

        return redirect()->route('dashboard')->with('success-org', 'Organization Association updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $organization = Organization::findOrFail($id);

        $organization->delete();

        return redirect()->route('dashboard')->with('success-org', 'Organization Association deleted successfully!');
    }
}
