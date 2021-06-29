<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CardController extends Controller
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
        return view('card.index');
    }

    public function all(Request $request)
    {
        $validated = $request->validate([
            'limit' => 'required|numeric|min:1|max:100',
        ]);

        $data = $this->Stripe->customers->allSources(
            $request->customer,
            ['object' => 'card', "limit" => $request->limit]
        );

        return $data;
    }

    public function create()
    {
        return view('card.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer'  => 'required',
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

        $token = $this->Stripe->tokens->create([
            'card' => $array,
          ]);

        $data = $this->Stripe->customers->createSource(
            $request->customer,
            ['source' => $token->id]
        );

        return $data;
    }

    public function edit($id)
    {
        return view('card.edit');
    }

    public function update(Request $request, $id)
    {
        $array = [];

        $validated = $request->validate([
            'customer'  => 'required',
            'card'      => 'required',
            'exp_month' => 'numeric|min:1|max:12',
            'exp_year'  => 'numeric|min:2022|max:2050',
        ]);


        if (isset($request->exp_year)) {
            $array['exp_year'] = $request->exp_year;
        }

        if (isset($request->exp_month)) {
            $array['exp_month'] = $request->exp_month;
        }
        
        $data = $this->Stripe->customers->updateSource(
            $id,
            $request->card,
            $array,
        );

        return $data;
    }

    public function delete()
    {
        return view('card.delete');
    }

    public function destroy(Request $request, $id)
    {
        $validated = $request->validate([
            'customer'  => 'required',
        ]);
        $data = $this->Stripe->customers->deleteSource(
            $request->customer,
            $id
        );

        return $data;
    }

    public function show($id)
    {
        return view('card.show');
    }

    public function retrieve(Request $request)
    {

        $validated = $request->validate([
            'card'      => 'required',
            'customer'  => 'required',
        ]);
        $data = $this->Stripe->customers->retrieveSource(
            $request->customer,
            $request->card
        );

        return $data;
    }
}
