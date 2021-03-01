<?php

namespace App\Http\Controllers;

use App\Domain\Services\Persistence\Sales\Customers\ICustomersRepository;
use App\Http\Resources\Customers\CustomersResource;
use Illuminate\Http\Request;

class Customers extends Controller
{

    /**
     * @var IBrandRepository
     */
    public $customersRepository;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

//    myMethod(23,3.45,2.13)
    public function __construct(ICustomersRepository $customersRepository)
    {
        $this->customersRepository = $customersRepository;
    }

    public function index()
    {
       $customers = $this->customersRepository->getAll();
        return json_encode($customers);
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
