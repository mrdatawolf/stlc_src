<?php namespace App\Imports\Sales;

use App\Models\GrayFrt;
use Maatwebsite\Excel\Concerns\ToModel;

class GrayFrtImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \App\Models\GrayFrt|\Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Model[]|null
     */
    public function model(array $row)
    {
        if(! empty($row[4]) && $row[4] !== 'RATE$') {
            return new GrayFrt([
                'town'  => $this->findName($row),
                'miles' => $row[3],
                'rate'  => $row[4],
                'value' => $this->getValue($row)
            ]);
        } else {
            return null;
        }
    }

    private function findName($row) {
        if(! empty($row[0])) {
            return $row[0];
        } elseif(! empty($row[1])) {
            return $row[1];
        }

        return $row[2];
    }

    private function getValue($row) {
        return $row[4]/24.192;
    }
}
