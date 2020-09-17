<?php

namespace App\Exports;

use App\Services\Facades\People;
use Maatwebsite\Excel\Concerns\FromCollection;

/**
 * @method download(string $string, string $CSV)
 */
class PopleFilmExport implements FromCollection
{
    private $data;

    public function __construct ($data) {
        $this->data = $data;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect($this->data);
    }
}
