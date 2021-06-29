<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe;

class PaymentMethodController extends Controller
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
        return view('paymentmethod.index');
    }

    public function all(Request $request)
    {
        $data = $this->Stripe->paymentMethods->all([
            'customer' => $request->customer,
            'type' => 'card',
        ]);
        return $data;
    }

    public function create()
    {
        return view('paymentmethod.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'number'    => 'required|numeric|digits:16',
            'cvc'       => 'required|numeric|digits:3|min:1',
            'exp_month' => 'required|numeric|min:1|max:12',
            'exp_year'  => 'required|numeric|min:2022|max:2050',
        ]);

        $array = array(
            'number'    => $request->number,
            'cvc'       => $request->cvc,
            'exp_month' => $request->exp_month,
            'exp_year'  => $request->exp_year,
        );

        $data = $this->Stripe->paymentMethods->create([
            'type' => 'card',
            'card' => $array,

        ]);

        return $data;
    }


    public function edit($id)
    {
        return view('paymentmethod.edit');
    }

    public function update(Request $request, $id)
    {
        $array = [];

        $validated = $request->validate([
            'exp_month' => 'numeric|min:1|max:12',
            'exp_year'  => 'numeric|min:2022|max:2050',
        ]);
        $array['card'] = array(
            'exp_month' => $request->exp_month,
            'exp_year'  => $request->exp_year
            );
        
        $data = $this->Stripe->paymentMethods->update(
            $id,
            $array,
        );

        return $data;
    }

    public function delete()
    {
        return view('paymentmethod.delete');
    }

    public function destroy(Request $request, $id)
    {
        $data = $this->Stripe->paymentMethods->detach(
            $id
        );

        return $data;
    }

    public function show($id)
    {
        return view('paymentmethod.show');
    }

    public function retrieve(Request $request)
    {
        $data = $this->Stripe->paymentMethods->retrieve(
            $request->id
        );

        return $data;
    }

    public function getcustomer()
    {
        return view('paymentmethod.getcustomer');
    }

    public function attach(Request $request)
    {
        $validated = $request->validate([
            'customer'  => 'required',
            'id'        => 'required',
        ]);

        $data = $this->Stripe->paymentMethods->attach(
            $request->id,
            ['customer' => $request->customer]
        );
        return $data;
    }
}
