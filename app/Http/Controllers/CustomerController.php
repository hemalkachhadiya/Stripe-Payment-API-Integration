<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe;

class CustomerController extends Controller
{
    protected $Stripe;
    public function __construct()
    {
        $this->Stripe = new \Stripe\StripeClient(
            \config('constants.STRIPE_SECRET')
        );
    }

    public function index(Request $request)
    {
        return view('customer.index');
    }

    public function all(Request $request)
    {
        $validated = $request->validate([
            'limit' => 'required|numeric|min:1|max:100',
        ]);

        $data = $this->Stripe->customers->all([
            "limit" => $request->limit,
        ]);

        return $data;
    }

    public function create()
    {
        return view('customer.create');
    }

    public function store(Request $request)
    {
        if (isset($request->email)) {
            $array['email'] = $request->email;
        }

        if (isset($request->name)) {
            $array['name'] = $request->name;
        }

        if (isset($request->phone)) {
            $array['phone'] = $request->phone;
        }

        if (isset($request->description)) {
            $array['description'] = $request->description;
        }

        if (isset($request->payment_method)) {
            $array['payment_method'] = $request->payment_method;
        }

        $data = $this->Stripe->customers->create(
            $array
        );

        return $data;
    }

    public function edit($id)
    {
        return view('customer.edit');
    }

    public function update(Request $request, $id)
    {
        $array = [];

        if (isset($request->email)) {
            $array['email'] = $request->email;
        }

        if (isset($request->name)) {
            $array['name'] = $request->name;
        }

        if (isset($request->phone)) {
            $array['phone'] = $request->phone;
        }

        if (isset($request->description)) {
            $array['description'] = $request->description;
        }

        $data = $this->Stripe->customers->update(
            $id,
            $array,
        );

        return $data;
    }

    public function delete()
    {
        return view('customer.delete');
    }

    public function destroy(Request $request, $id)
    {
        $data = $this->Stripe->customers->delete(
            $id
        );

        return $data;
    }

    public function show($id)
    {
        return view('customer.show');
    }

    public function retrieve(Request $request)
    {
        $data = $this->Stripe->customers->retrieve(
            $request->customer
        );

        return $data;
    }
}
