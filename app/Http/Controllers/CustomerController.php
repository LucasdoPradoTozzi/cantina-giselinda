<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    public function index()
    {
        $customers = Customer::latest()->paginate(10);
        return view('customers.index', ['customers' => $customers]);
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string',
            'doc1'      => 'nullable|numeric|unique:customers,doc1',
            'doc2'      => 'nullable|string|unique:customers,doc2',
            'birthday'  => 'nullable|date',
            'email'     => 'nullable|email|unique:customers,email'
        ]);

        Customer::create([
            'name'            => $request->input('name'),
            'doc1'            => $request->input('doc1'),
            'doc2'            => $request->input('doc2'),
            'birthday'        => $request->input('birthday'),
            'email'           => $request->input('email')
        ]);

        return redirect()->route('customers.index');
    }
}
