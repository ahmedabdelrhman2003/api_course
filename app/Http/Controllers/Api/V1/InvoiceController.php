<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Invoice;
use App\Http\Requests\V1\StoreInvoiceRequest;
use App\Http\Requests\V1\UpdateInvoiceRequest;
use App\Http\Requests\V1\BulkStoreInvoicesRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\InvoiceResource;
use App\Http\Resources\V1\InvoiceCollection;
use Illuminate\Http\Request;
use App\Filters\V1\invoiceFilter;
use Illuminate\Support\Arr;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new invoiceFilter();
        $queryItem = $filter->transform($request);
        if (count($queryItem) == 0) {


            return new invoiceCollection(invoice::paginate(10));
        } else {
            $invoices = Invoice::where([$queryItem])->paginate();
            return new InvoiceCollection($invoices->appends($request->query()));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInvoiceRequest $request)
    {
        //
    }

    function bulkStore(BulkStoreInvoicesRequest $request)
    {
        $bulk = collect($request->all())->map(function ($arr, $keys) {
            return Arr::except($arr, ['customerId', 'billedDate', 'paidDate']);
        });
        $invoice = Invoice::insert($bulk->toArray());
        return $invoice;
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        return new InvoiceResource($invoice);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInvoiceRequest $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
