<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::latest()->simplePaginate(10);
        $type = "company";
        return view('dashboard', compact('companies', 'type'))
            ->with('i', (request()->input('page', 1) -1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create', ['type' => 'company']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'logo' => 'dimensions:ratio=1/1',
        ]);
        
        $fileName = $request->name . '.' . $request->file('logo')->extension();
        $request->file('logo')->storeAs('public', $fileName);

        $logo = 'storage/'.$fileName;
        
        $storing = Company::create([
            'name' => $request->name,
            'email' => $request->email,
            'logo' => $logo,
            'website' => $request->website,
        ]);

        if ($storing){
            return redirect()->route('company.index')
                            ->with('success', 'Saved Successfully!');
        }else{
            return redirect()->route('company.create')
                            ->with('error', 'Failed Save! Please Try Again!');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        return view('admin.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        $type = 'company';
        return view('admin.edit', compact('company', 'type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        $request->validate([
            'name' => 'required',
            'logo' => 'dimensions:ratio=1/1,min_width=100,min_height=100',
        ]);
        
        $fileName = $request->name . '.' . $request->file('logo')->extension();
        $request->file('logo')->storeAs('public/', $fileName);

        $logo = 'storage/'.$fileName;

        $storing = $company->update([
            'name' => $request->name,
            'email' => $request->email,
            'logo' => $logo,
            'website' => $request->website,
        ]);

        if ($storing){
            return redirect()->route('company.index')
                            ->with('success', 'Update Successfully!');
        }else{
            return redirect()->route('company.update')
                            ->with('error', 'Failed Update! Please Try Again!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $company->delete();

        return redirect()->route('company.index')
                        ->with('success', 'Delete Successfully!');
    }
}
