<?php

namespace App\QueryFilters;

use Carbon\Carbon;

class From extends Filter {

    /**
     * @Function   applyFilters
     * @param $nextstep
     * @Author    : Michail Fragkiskos
     * @Created at: 4/11/2020 at 5:58 μ.μ.
     * @return mixed
     */
    public function applyFilters($nextstep) {

        if (strtotime(Request()->get('from')) !== false) {
            $formatedDate = Carbon::parse (Request()->get('from'),'UTC');
           $date = $formatedDate->isoFormat('Y-MM-DD');
            return $nextstep->setData([0 => $date]);
        }
            return $nextstep;


    }


}
