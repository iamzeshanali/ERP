<?php

namespace App\Http\Controllers;

use App\Domain\Services\Persistence\Sales\ICustomerRepository;
use App\Http\Resources\Customers\CustomersResource;
use Illuminate\Http\Request;

class Customers extends Controller
{



    /**
     * @var IBrandRepository
     */
    public $customerRepository;
    /**s
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

//    myMethod(23,3.45,2.13)
    public function __construct(ICustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function index()
    {
       $customers = $this->customerRepository->getAll();

        $formattedData = [];

        foreach ($customers as $customer) {
            $formattedData[] = [
                'Name' => $customer->customerName,
                'customerNumber' => $customer->customerNumber,
                'customerStatus' => $customer->customerStatus->getValue(),
                'email' => $customer->email->asString(),
                'salesRepresentative' => $customer->salesRepresentative->name,
                'addressLine1' => $customer->addressLine1,
                'addressLine2' => $customer->addressLine2,
                'state' => $customer->state,
                'city' => $customer->city,
                'zip' => $customer->zip,
                'country' => $customer->country,
                'isShippingSame' => $customer->isShippingSame,
                'shippingAddressLine1' => $customer->shippingAddressLine1,
                'shippingAddressLine2' => $customer->shippingAddressLine2,
                'shippingState' => $customer->shippingState,
                'shippingCity' => $customer->shippingCity,
                'shippingZip' => $customer->shippingZip,
                'shippingCountry' => $customer->shippingCountry,
                'phone' => $customer->phone,
                'bevLicenceNumber' => $customer->bevLicenceNumber,
                'paymentTerms' => $customer->paymentTerms->code,
                'numberOfPallets' => $customer->numberOfPallets
            ];
        }
        return response()->json($formattedData);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
