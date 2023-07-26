<?php

namespace App\Imports;

use App\Models\StyleBpoOrder;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;

class BpoOrderImport implements ToModel
{
    protected $masterStyleId;

    public function __construct($masterStyleId)
    {
        $this->masterStyleId = $masterStyleId;
    }

    public function model(array $row)
    {
        return new StyleBpoOrder([
           'master_style_id'     => $this->masterStyleId,
           'bpo_name'    => $row[0],
           'order_quantity' => $row[1],
        ]);
    }
}
