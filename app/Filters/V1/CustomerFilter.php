<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;

class CustomerFilter extends ApiFilter
{
    protected $safeParam = [
        'id' => ['eq'],
        'name' => ['eq'],
        'type' => ['eq'],
        'email' => ['eq'],
        'address' => ['eq'],
        'city' => ['eq'],
        'state' => ['eq'],
        'postalCode' => ['eq', 'gt', 'lt'],
    ];
    protected $columnMap = ['postalCode' => 'postal_code'];
}
