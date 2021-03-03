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
                'customer Number' => $customer->customerNumber,
                'customer Status' => $customer->customerStatus->getValue(),
                'email' => $customer->email->asString(),
                'sales Representative' => $customer->salesRepresentative->name,
                'address Line1' => $customer->addressLine1,
                'address Line2' => $customer->addressLine2,
                'state' => $customer->state,
                'city' => $customer->city,
                'zip' => $customer->zip,
                'country' => $customer->country,
                'isShippingSame' => $customer->isShippingSame,
                'shipping AddressLine1' => $customer->shippingAddressLine1,
                'shipping AddressLine2' => $customer->shippingAddressLine2,
                'shipping State' => $customer->shippingState,
                'shipping City' => $customer->shippingCity,
                'shipping Zip' => $customer->shippingZip,
                'shipping Country' => $customer->shippingCountry,
                'phone' => $customer->phone,
                'bevLicence Number' => $customer->bevLicenceNumber,
                'payment Terms' => $customer->paymentTerms->code,
                'number Of Pallets' => $customer->numberOfPallets
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
