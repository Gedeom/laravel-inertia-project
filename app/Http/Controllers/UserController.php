<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use App\Models\User;
use Illuminate\Support\Collection;
use Inertia\Inertia;
use ProtoneMedia\LaravelQueryBuilderInertiaJs\InertiaTable;
use App\Utils\TableUtils;

class UserController extends Controller
{
    public function __invoke()
    {
        $globalSearch = TableUtils::makeGlobalSearch(['email', 'name']);

        $users = QueryBuilder::for(User::class)
            ->defaultSort('name')
            ->allowedSorts(['name', 'email'])
            ->allowedFilters(['name', 'email', $globalSearch])
            ->paginate(request()->query('perPage', 15))
            ->withQueryString();

        return Inertia::render('User/Index', [
            'users' => $users
        ])->table(function (InertiaTable $table) {
             $table
              ->withGlobalSearch()
              ->defaultSort('name')
              ->column(key: 'name', label: 'Nome', searchable: true, sortable: true, canBeHidden: false)
              ->column(key: 'email', searchable: true, sortable: true);
        });
    }
}
