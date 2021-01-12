<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Services\AbilityService;

use App\Http\Requests\Abilities\StoreRequest;
use App\Http\Requests\Abilities\UpdateRequest;

use Silber\Bouncer\Database\Ability;
use Yajra\Datatables\Datatables;


class AbilityController extends Controller
{

    /**
     * Display a listing of Ability.
     *
     * @return view
     */
    public function index()
    {
        // $this->authorize('index', Abilities::class);

        return view('admin.abilities.list');
    }

    /**
     * Informações para datatables
     *
     * @return datatable
     */
    public function datatables(AbilityService $abilityService)
    {
        // $this->authorize('index', Abilities::class);

        //obtendo informações para datatable
        $abilities = $abilityService->selectDataTable();

        //retornando datatables
        return Datatables::of($abilities)
            ->addColumn('action', function ($ability) {

                // $edit = view('partials.components.action', ['action' => 'edit', 'route' => route('admin.abilities.edit', ['ability' => $ability->id]), 'ability' => 'admin-abilities-update', 'class' => 'list-icons-item ' . IconsHelper::getColor('update'), 'classIcon' => IconsHelper::getIcon('update'), 'title' => __('app.actions.labels.edit')] )->render();
                // $delete = view('partials.components.action', ['action' => 'delete', 'route' => route('admin.abilities.delete', ['ability' => $ability->id]), 'ability' => 'admin-abilities-delete', 'class' => 'btn-removal list-icons-item ' . IconsHelper::getColor('delete'), 'classIcon' => IconsHelper::getIcon('delete'), 'title' => __('app.actions.labels.delete') ])->render();

                return '<div class="list-icons">'  . '</div>';
            })
            ->editColumn('created_at', function($ability) {
                return $ability->created_at->format('d-m-Y H:i');
            })
            ->make(true);
    }

    /**
     * Show the form for creating new Ability.
     *
     * @return view
     */
    public function create()
    {
        $this->authorize('create', Abilities::class);
        return view('admin.administracao.abilities.create');
    }

    /**
     * Store a newly created Role in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $this->authorize('create', Abilities::class);
        $ability = $this->AbilitiesRepository->store(request());
        
        if($ability)
            return redirect(route('admin.abilities.index'));

        return back()->withInput();
    }

    /**
     * Show the form for editing Ability.
     *
     * @param  int - id da permissão
     * @return view
     */
    public function edit($id)
    {
        $this->authorize('update', Abilities::class);
        $ability = $this->AbilitiesRepository->find($id);
        return view('admin.administracao.abilities.edit', compact('ability'));
    }

    /**
     * Update Ability in storage.
     *
     * @param  \App\Http\Requests\Abilities\UpdateRequest  $request
     * @param  int - id da Permissão
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $this->authorize('update', Abilities::class);

        if($this->AbilitiesRepository->update($request, $id))
            return redirect(route('admin.abilities.index'));

        return back()->withInput();
    }

    /**
     * Remove Ability from storage.
     *
     * @param  int - id da permissão
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('delete', Abilities::class);
        return $this->AbilitiesRepository->delete($id);
    }

}