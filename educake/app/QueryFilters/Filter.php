<?php

namespace App\QueryFilters;

use Closure;
use Illuminate\Support\Str;

abstract class Filter {

    /**
     * @Function   handle
     * @param $nextrequest
     * @param Closure $next
     * @Author    : Michail Fragkiskos
     * @Created at: 4/11/2020 at 5:56 μ.μ.
     * @return mixed
     */
    public function handle($nextrequest, Closure $next ) {

        if (!Request()->has($this->filterName())) {
            return $next($nextrequest);
        }
         $builder = $next($nextrequest);
        return $this->applyFilters($builder);
    }

    /**
     * @Function   applyFilters
     * @param $nextstep
     * @Author    : Michail Fragkiskos
     * @Created at: 4/11/2020 at 5:56 μ.μ.
     * @return mixed
     */
    protected abstract function applyFilters($nextstep);

    /**
     * @Function   filterName
     * @Author    : Michail Fragkiskos
     * @Created at: 4/11/2020 at 5:56 μ.μ.
     * @return string
     */
    protected function filterName() {
        return Str::snake(class_basename($this));
    }


}
