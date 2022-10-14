<?php

namespace App\Http\Controllers;

use App\Models\State;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use App\Models\User;
use Illuminate\Support\Collection;
use Inertia\Inertia;
use ProtoneMedia\LaravelQueryBuilderInertiaJs\InertiaTable;
use App\Utils\TableUtils;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $columns = ['name', 'doc','email','opening_date'];

        $globalSearch = TableUtils::makeGlobalSearch($columns);
        
        $users = QueryBuilder::for(Supplier::class)
        ->join('persons', 'persons.id', '=', 'person_id')
            ->defaultSort('name')
            ->allowedSorts($columns)
            ->allowedFilters(array_merge($columns, [$globalSearch]))
            ->paginate(request()->query('perPage', 15))
            ->withQueryString();

        return Inertia::render('Supplier/Index', [
            'suppliers' => $users
        ])->table(function (InertiaTable $table) {
             $table
              ->withGlobalSearch()
              ->column(key: 'name', label: 'Nome', searchable: true, sortable: true, canBeHidden: false)
              ->column(key: 'doc', label: 'CPF/CNPJ', searchable: true, sortable: true)
              ->column(key: 'email', searchable: true, sortable: true)
              ->column(key: 'opening_date', label: 'Data de abertura', searchable: true, sortable: true);
        });
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    
        return Inertia::render('Supplier/SupplierForm', [
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        //
    }
}
