<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;

class InvoiceFilter extends ApiFilter
{
    protected $safeParam = [
        'customerId' => ['eq'],
        'amount' => ['eq', 'lte', 'lt', 'gt', 'gte'],
        'billedData' => ['eq', 'lte', 'lt', 'gt', 'gte'],
        'paidData' => ['eq', 'lte', 'lt', 'gt', 'gte'],
        'status' => ['eq', 'ne']
    ];
    protected $columnMap = [
        'billedData' => 'billed_date',
        'paidData' => 'paid_date',
        'customerId' => 'customer_id',

    ];
    protected $operatorMap = [
        'ne' => '!=',
        'eq' => '=',
        'gt' => '>',
        'gte' => '=',
        'lt' => '<',
        'lte' => '<=',
    ];
}
