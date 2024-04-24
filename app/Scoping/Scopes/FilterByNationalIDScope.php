<?php

namespace App\Scoping\Scopes;

use App\Scoping\Contracts\Scope;
use Illuminate\Database\Eloquent\Builder;

class FilterByNationalIDScope implements Scope
{
    /**
     * @param Builder $builder
     * @param string|null $value
     * @return void
     */
    public function apply(Builder $builder, ?string $value): void
    {
        if($value) {
            $builder->where('nationalityID', $value);
        }
    }
}
