<?php namespace App\Imports\Sales;

use App\Models\Orders;
use Maatwebsite\Excel\Concerns\ToModel;

class OrdersImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \App\Models\Orders|\Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Model[]|null
     */
    public function model(array $row)
    {
         return new Orders([
            'name' => $row[0],
            'released' => $row[1],
            'need_re' => $row[2],
            'order_number' => $row[3],
            'po_number' => $row[4],
            'quantity' => $row[5],
            'thick' => $row[6],
            'width' => $row[7],
            'length' => $row[8],
            'grade' => $row[9],
            'mill' => $row[10],
            'frt' => $row[11],
            'total' => $row[12],
        ]);
    }
}
