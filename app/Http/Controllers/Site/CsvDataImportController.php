<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\General\SmsReceive;
use App\Models\General\TabiatCode;
use Illuminate\Http\Request;

class CsvDataImportController extends Controller
{
    public function import(){
        ini_set('memory_limit', '8024M'); // or you could use 1G
        // dd(getcwd());
        // return $this->import_sms_recieve();
        // return $this->import_codes();

    }

    protected function import_sms_recieve(){
        for ($x = 1; $x <= 5; $x++) {
            $handle = fopen("/home/tabiaaat/domains/used/" . $x . ".csv", "r") or die("Couldn't get handle");
            if ($handle) {
                $i       = 0;
                $records = [];
                while (!feof($handle)) {
                    $i++;
                    $line  = fgets($handle);
                    $line  = trim($line, "\r\n");
                    $array = explode("?", $line);

                    $records[] = [
                        'sender' => '0' . $array[0],
                        'note'   => $array[1],
                    ];

                    if ($i == 2000) {
                        SmsReceive::insert($records);
                        unset($line);
                        unset($array);
                        unset($records);
                        $i       = 0;
                        $records = [];
                    }

                    // dd($code);
                    // Process line here..
                }
                if (count($records)) {
                    SmsReceive::insert($records);
                }
                fclose($handle);
            }
        }
        return SmsReceive::count();
    }

    protected function import_codes(){
        for ($x = 1; $x <= 41; $x++) {
            $handle = fopen("/home/tabiaaat/domains/" . $x . ".csv", "r") or die("Couldn't get handle");
            if ($handle) {
                $i       = 0;
                $records = [];
                while (!feof($handle)) {
                    $i++;
                    $line  = fgets($handle);
                    $line  = trim($line, "\r\n");
                    $array = explode("?", $line);

                    $records[] = [
                        'code'              => $array[0],
                        'tabiat_product_id' => $array[1],
                    ];

                    if ($i == 2000) {
                        TabiatCode::insert($records);
                        $i       = 0;
                        $records = [];
                    }

                    // dd($code);
                    // Process line here..
                }
                if (count($records)) {
                    TabiatCode::insert($records);
                }
                fclose($handle);
            }
        }

        return TabiatCode::count();
    }

}
