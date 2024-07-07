<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('page.dashboard.customer.index', [
            'customers' => Customer::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('page.dashboard.customer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required'
        ]);
        
        $last_customer_id = Customer::latest()->first()?->id;
        $customer_code = 'CS'. sprintf('%03d', $last_customer_id + 1);
        
        Customer::create([
            'code' => $customer_code,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender
        ]);
        
        return redirect()->route('dashboard.customer.index')->with('success', 'Successfuly add customer');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        return view('page.dashboard.customer.show', [
            'customer' => $customer
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        return view('page.dashboard.customer.edit', [
            'customer' => $customer
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'first_name' => 'required'
        ]);
        
        $customer->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender
        ]);
        
        return redirect()->route('dashboard.customer.index')->with('success', 'Successfuly update customer');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        $customer->delete();
        
        return redirect()->route('dashboard.customer.index')->with('success', 'Successfuly delete customer');
    }
}
