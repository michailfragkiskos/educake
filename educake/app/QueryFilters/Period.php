<?php

namespace App\QueryFilters;


class Period extends Filter {
    /**
     * @Function   applyFilters
     * @param $nextstep
     * @Author    : Michail Fragkiskos
     * @Created at: 4/11/2020 at 5:58 μ.μ.
     * @return mixed
     */
    public function applyFilters($nextstep) {

        return $nextstep->setData([1 => Request()->get('period')]);
    }
}
