<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\RolesDataTable;
use App\DataTables\UsersDataTable;
use App\Helpers\Alert;
use App\Helpers\Theme;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoleCreateRequest;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserProfileUpdate;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Role;
use App\Models\User;
use App\Models\PestPacBranch;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 *
 */
class UserController extends Controller
{
    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * @param UserRepository $repository
     */
    public function __construct( UserRepository $repository )
    {
        $this->repository = $repository;
    }// __construct

    /**
     * @return Application|Factory|View
     */
    public function index( UsersDataTable $dataTable )
    {
        return $dataTable->render( 'admin.users.index', [ 'roles' => Role::all() , 'branches' => PestPacBranch::all()  ] );
    }// index

    /**
     *
     */
    public function show()
    {
        $user = Auth::user();
        return Theme::view( 'users.profile', compact( 'user' ) );
    }// show

    /**
     * @param UserProfileUpdate $request
     *
     * @return RedirectResponse
     */
    public function updateProfile( UserProfileUpdate $request )
    {
        $user = Auth::user();
        $data = $request->all();
        if( !empty( $data[ 'password' ] ) ) {
            $data[ 'password' ] = Hash::make( $data[ 'password' ] );
        } else {
            unset( $data[ 'password' ] );
        }
        $user->fill( $data )->update();
        Alert::success( 'Profile Updated' );
        return back();
    }

    /**
     * @param UserCreateRequest $request
     *
     * @return JsonResponse
     */
    public function store( UserCreateRequest $request )
    {
        $data = $request->all();
        $data[ 'password' ] = Hash::make( $data[ 'password' ] );
        $user = User::create( $data );

        $user->roles()->sync( $request->roles );
        $user->branches()->sync( $request->branches );

        return new JsonResponse( [ 'message' => 'User Added' ], 201 );
    }// store

    /**
     * @param User $user
     *
     * @return JsonResponse
     */
    public function edit( User $user )
    {
        $user->load( 'roles' );
        $roles = $user->roles->map( static function( $row ) {
            return $row->id;
        } );
        $user->role_ids = $roles;

        $user->load( 'branches' );
        $branches = $user->branches->map( static function( $row ) {
            return $row->id;
        } );
        $user->branch_ids = $branches;

        return new JsonResponse( $user );
    }// edit

    public function update( UserUpdateRequest $request, User $user )
    {
        $data = $request->all();
        if( !empty( $data[ 'password' ] ) ) {
            $data[ 'password' ] = Hash::make( $data[ 'password' ] );
        } else {
            unset( $data[ 'password' ] );
        }
        $user->fill( $data )->update();
        $user->roles()->sync( $request->roles );
        $user->branches()->sync( $request->branches );
        return new JsonResponse( [ 'message' => 'User Updated' ] );
    }// edit


    /**
     * @param User $user
     *
     * @return JsonResponse
     */
    public function destroy( User $user )
    {
        $user->delete();

        return new JsonResponse( [ 'message' => 'User deleted' ] );
    }// destroy
}
