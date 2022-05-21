<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\RolesDataTable;
use App\Helpers\Theme;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoleCreateRequest;
use App\Models\Role;
use App\Repositories\RoleRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 *
 */
class RoleController extends Controller
{
    /**
     * @var RoleRepository
     */
    private $repository;

    /**
     * @param RoleRepository $repository
     */
    public function __construct( RoleRepository $repository )
    {
        $this->repository = $repository;
    }// __construct

    /**
     * @return Application|Factory|View
     */
    public function index( RolesDataTable $dataTable )
    {
        return $dataTable->render( 'admin.roles.index' );
    }// index

    /**
     * @param RoleCreateRequest $request
     *
     * @return JsonResponse
     */
    public function store( RoleCreateRequest $request )
    {
        Role::create( $request->only( [ 'label', 'permissions' ] ) );

        return new JsonResponse( [ 'message' => 'Role Added' ], 201 );
    }// store

    /**
     * @param Role $role
     *
     * @return JsonResponse
     */
    public function edit( Role $role )
    {
        return new JsonResponse( $role );
    }// edit

    public function update( RoleCreateRequest $request, Role $role )
    {
        $role->fill( $request->only( [ 'label', 'permissions' ] ) )->update();
        return new JsonResponse( [ 'message' => 'Role Updated' ] );
    }// edit


    /**
     * @param Role $role
     *
     * @return JsonResponse
     */
    public function destroy( Role $role )
    {
        $role->delete();

        return new JsonResponse( [ 'message' => 'Role deleted' ] );
    }// destroy

}
