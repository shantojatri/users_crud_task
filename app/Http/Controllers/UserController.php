<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use App\DataTables\UserDataTable;
use App\Interfaces\UserInterface;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\UserStoreRequest;
use App\DataTables\UsersTrashedDataTable;

class UserController extends Controller
{
    /**
     * Construct property promotion and Dependency injection
     */
    public function __construct(protected UserInterface $userService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(UserDataTable $dataTable): Mixed
    {
        return $dataTable->render('user.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.     *
     */
    public function store(UserStoreRequest $request) : RedirectResponse
    {
        $validated = $request->validated();
        $this->userService->storeData($request, $validated);
        record_created_flash();

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id) : View
    {
        $user = User::with('address:id,user_id,address,country,state')->where('id', $id)->first();
        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id): View
    {
        $user = User::with('address:id,user_id,address,country,state')->where('id', $id)->first();
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserStoreRequest $request, User $user): RedirectResponse
    {
        $validated = $request->validated();
        $this->userService->updateData($request, $validated, $user);
        record_updated_flash();

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): RedirectResponse
    {

        $this->userService->deleteData($user);
        record_deleted_flash();

        return redirect()->route('users.index');
    }

    /**
     *  Get all the trashed users
     */
    public function trashed(UsersTrashedDataTable $dataTable): Mixed
    {
        return $dataTable->render('user.trashed');
    }

    /**
     *  Restore a single user
     */
    public function restore(int $id): RedirectResponse
    {
        $this->userService->restoreData($id);
        record_created_flash('User restored successfully');

        return back();
    }

    /**
     *  Restore a single user
     */
    public function permanentDelete($id): RedirectResponse
    {
        $this->userService->forceDeleteData($id);
        record_deleted_flash('User permanently deleted successfully');

        return back();
    }
}
