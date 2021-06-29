<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChargeController extends Controller
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
        return view('charge.index');
    }

    public function all(Request $request)
    {
        $validated = $request->validate([
            'limit' => 'required|numeric|min:1|max:100',
        ]);

        $data = $this->Stripe->charges->all([
            'limit' => $request->limit
        ]);

        return $data;
    }

    public function create()
    {
        return view('charge.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'number'    => 'required|numeric|digits:16',
            'cvc'       => 'required|numeric|digits:3|min:1',
            'exp_month' => 'required|numeric|min:1|max:12',
            'exp_year'  => 'required|numeric|min:2022|max:2050',
            'amount'    => 'required|numeric|min:100|max:99999999',
            'currency'  => 'required',
        ]);

        $array = array(
            'number'    => $request->number,
            'cvc'       => $request->cvc,
            'exp_month' => $request->exp_month,
            'exp_year'  => $request->exp_year,
        );

        $token = $this->Stripe->tokens->create([
            'card' => $array,
          ]);

        $data = $this->Stripe->charges->create([
            'amount' => $request->amount,
            'currency' => $request->currency,
            'source' => $token->id,
            'capture' => false  //for capatured method
          ]);

        return $data;
    }

    public function edit($id)
    {
        return view('charge.edit');
    }

    public function update(Request $request, $id)
    {
        $array = [];
        $validated = $request->validate([
            'fraud_details'  => 'required',
        ]);
        
        $array['fraud_details']['user_report'] = $request->fraud_details;
        // dd($array);
        $data = $this->Stripe->charges->update(
            $id,
            $array,
        );

        return $data;
    }

    public function delete()
    {
        return view('charge.delete');
    }

    public function destroy(Request $request, $id)
    {
        $data = $this->Stripe->charges->capture(
            $id
        );

        return $data;
    }

    public function show($id)
    {
        return view('charge.show');
    }

    public function retrieve(Request $request)
    {
        $validated = $request->validate([
            'charge'  => 'required',
        ]);
        $data = $this->Stripe->charges->retrieve(
            $request->charge,
            []
        );

        return $data;
    }
}
