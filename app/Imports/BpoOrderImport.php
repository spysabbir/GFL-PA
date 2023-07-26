<?php

namespace App\Imports;

use App\Models\StyleBpoOrder;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class BpoOrderImport implements ToModel, WithHeadingRow, WithValidation
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
           'bpo_no'    => $row['bpo_no'],
           'order_quantity' => $row['order_quantity'],
           'created_by' => Auth::user()->id,
        ]);
    }

    public function rules(): array
    {
        return [
            'bpo_no' => 'required',
            'order_quantity' => 'required',
        ];
    }
}
