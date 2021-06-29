
# Stripe-Payment-API-Integration

Stripe is one of the popular payment gateways and it works very well and easy to use integration.

## Installation

```cmd
composer install
npm install
php artisan key:generate
```
Note make sure stripe dependencies installed in composer if any case does not install dependencies please use use 
```cmd
composer require stripe/stripe-php
```
## use stripe in laravel
```
use Stripe;
```
add in every controller which you need to use stripe

The customer section is one of the important sections in stripe so blow some steps for it.
```PHP
 protected $Stripe;
    public function __construct()
    {
        $this->Stripe = new \Stripe\StripeClient(
            \config('constants.STRIPE_SECRET')
        );
    }

```
add $stripe variable for all function and construct for add method get stripe secret key
```PHP
public function all(Request $request)
    {
        $data = $this->Stripe->customers->all([
            "limit" => $request->limit,
        ]);
        return $data;
    }
```
get all customers list according to limit default limit=10 but you can change 0 to 100.
```PHP
 public function store(Request $request)
    {
        $array['email'] = $request->email;
        $array['name'] = $request->name;
        $data = $this->Stripe->customers->create(
            $array
        );
        return $data;
    }
```
you can create customers with anyone variable. not need to get customer data for stripe payment. store only those data which need to verify with stripe.

Same as create you just need to pass the id of the customer for update with updated value for it.
```PHP
public function update(Request $request, $id)
    {
        if (isset($request->description)) {
            $array['description'] = $request->description;
        }
        $data = $this->Stripe->customers->update(
            $id,
            $array,
        );
        return $data;
    }
```

You can also retrieve customer form stripe using the below code
```
 public function retrieve(Request $request)
    {
        $data = $this->Stripe->customers->retrieve(
            $request->customer
        );
        return $data;
    }
```
stripe also provide delete customer feature in these dependencies 

```PHP
public function destroy($id)
    {
        $data = $this->Stripe->customers->delete(
            $id
        );

        return $data;
    }
```

The above code for only customers sections you can create many other sections like charge, card,  token many more.

## More 
If you want to more details about it please visit this site:
[Stripe API](https://stripe.com/docs/api)