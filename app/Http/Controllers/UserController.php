<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use App\DataTables\UserDataTable;
use App\Interfaces\UserInterface;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\UserStoreRequest;

class UserController extends Controller
{
    /**
     * Construct property promotion and Dependency injection
     */
    public function __construct(private UserInterface $userService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(UserDataTable $dataTable)
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
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        try {
            $this->userService->storeOrUpdateData($request, $validated, null);
            record_created_flash();
        } catch (\Exception $e) {
            log_error($e);
        }
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): View
    {
        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user): View
    {
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserStoreRequest $request, User $user): RedirectResponse
    {
        $validated = $request->validated();

        try {
            $this->userService->storeOrUpdateData($request, $validated, $user);record_updated_flash();
        } catch (\Exception $e) {
            log_error($e);
        }
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): RedirectResponse
    {

        try {
            $this->userService->deleteData($user);
            record_deleted_flash();
        } catch (\Exception $e) {
            log_error($e);
        }

        return redirect()->route('users.index');
    }
}
