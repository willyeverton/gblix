<?php

namespace App\Exports;

use App\Services\Facades\People;
use Maatwebsite\Excel\Concerns\FromCollection;

/**
 * @method download(string $string, string $CSV)
 */
class PopleFilmExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect(People::all());
    }
}
