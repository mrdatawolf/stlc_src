<?php namespace App\Imports\Sales;

use App\Models\TMC;
use Maatwebsite\Excel\Concerns\ToModel;

class TMCImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \App\Models\TMC|\Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Model[]|null
     */
    public function model(array $row)
    {
        if($this->isValidRow($row)) {

            $meetMinimum = $this->meetMinimum($row);
            $dollarValue = $this->dollarValue($row);
            $costNoTarp  = $this->costNoTarp($row);
            $costTarped  = $this->costTarped($row);
            $perm        = $this->perm($row);

            return new TMC([
                'origin_state'               => $row[0],
                'origin_city'                => $row[1],
                'origin_county'              => $row[2],
                'origin_zip_code'            => $row[3],
                'destination_state'          => $row[4],
                'destination_city'           => $row[5],
                'proposed_rate_mile_flatbed' => $row[6],
                'minimum'                    => $row[7],
                'fsc_7_18'                   => $row[8],
                'six_thirteen'               => $row[9],
                'meet_minimum'               => $meetMinimum,
                'miles'                      => $row[11],
                'dollar_value'               => $dollarValue,
                'cost_no_tarp'               => $costNoTarp,
                'cost_tarped'                => $costTarped,
                'per_m'                      => $perm,
            ]);
        }
        else {
            return null;
        }
    }


    private function isValidRow($row) {
        if(in_array($row[0],  ['Origin State', '']) || $row[1] === null || $row[10] === '=') {

            return false;
        }
        return true;
    }


    /**
     * note: this is g*l or nothing or hand set
     * @param $row
     *
     * @return int|string
     */
    private function meetMinimum($row) {
        if(trim($row[10]) == '') {
            return '';
        }

        return (substr($row[10],0,1) === '=') ? $row[6]*$row[11] : $row[10];
    }


    /**
     * note: this is l*i or g*i or a static value*i or just g or a static value
     * @param $row
     *
     * @return int|string
     */
    private function dollarValue($row) {
        if(trim($row[12]) == '') {
            return '';
        }
        if((substr($row[12],0,1) === '=')) {
            //find out what it is
            $array = explode('*', substr($row[12],1));
            $gValue = 1;
            $iValue = 1;
            $lValue = 1;
            $staticValue = 1;
            foreach ($array as $input) {
                $column = substr($input,0,1);
                switch($column) {
                    case 'G':
                        $gValue = $row[6];
                    break;
                    case 'I':
                        $iValue = $row[8];
                    break;
                    case 'L':
                        $lValue = $row[11];
                        break;
                    default:
                        $staticValue = (int) $input;
                }
            }

            return $gValue * $iValue * $lValue  * $staticValue;
        } else {

            return $row[12];
        }
    }


    /**
     * notes: l*i+h or g*l or m*l
     * @param $row
     *
     * @return int|string
     */
    private function costNoTarp($row) {
        $lValue = 1;
        $iValue = 1;
        $gValue = 1;
        $mValue = 1;
        $hValue = 0;
        $plusArray = explode('+',$row[13]);
        if(count($plusArray) > 1){
            $timesString = (strpos($plusArray[0], 'H') === false) ? $plusArray[0] : $plusArray[1];
            $hValue = $row[7];
        } else {
            $timesString = $row[13];
        }
        if(substr($timesString, 0, 1) === '=') {
            $array = explode('*', substr($timesString,1));
        } else {
            $array = explode('*', $timesString);
        }
        foreach ($array as $input) {
            switch (substr($input, 0, 1)) {
                case 'G':
                    $gValue = $row[6];
                    break;
                case 'I':
                    $iValue = $row[8];
                    break;
                case 'L':
                    $lValue = $row[11];
                    break;
                case 'M':
                    $mValue = $this->dollarValue($row);
                    break;
            }
        }
        $multipliers =  $gValue * $lValue * $mValue * $iValue;

        return $multipliers + $hValue;
    }


    /**
     * note: n+static
     * @param $row
     *
     * @return int|string
     */
    private function costTarped($row) {
        if(substr($row[14], 0, 1) === '=') {
            $n = $this->costNoTarp($row);
            $plusArray = explode('+',$row[14]);
            $static = (strpos($plusArray[0], 'N') === false) ? $plusArray[0] : $plusArray[1];

            return $n + $static;
        }

        return $row[14];
    }

    private function perm($row) {
        $costTarped = $this->costTarped($row);
        if(substr($row[15], 0, 1) === '=') {
            $divideArray = explode('/',$row[15]);
            $static = (strpos($divideArray[0], 'O') === false) ? $divideArray[0] : $divideArray[1];

            return $costTarped + $static;
        }

        return $row[15];
    }
}
