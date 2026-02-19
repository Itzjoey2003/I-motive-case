<?php

namespace App\Filter\V1;

use Illuminate\Http\Request;
use App\Filter\ApiFilter;

class LeadsFilter extends ApiFilter {
    protected $allowedParams = [
        'Status' => ['eq']
    ];

    protected $columnMap = [
        'Status' => 'Status'
    ];

    protected $operatorMap = [
        'eq' => '=',
    ];
}



?>