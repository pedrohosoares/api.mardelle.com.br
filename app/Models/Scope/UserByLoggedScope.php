<?php

namespace App\Models\Scope;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class UserByLoggedScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        dd(getUserLoggedIsAdmin());
        if(!getUserLoggedIsAdmin())
        {
            dd(getUserLoggedId());
            //$builder->where('users.id', getUserLoggedId());
        }
    }
}
