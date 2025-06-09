<?php

namespace App\Http\Controllers\Api;

use App\DataTransferObjects\User\UserData;
use App\DataTransferObjects\User\UserDataUpdate;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\UserRepository;

class UserController extends Controller
{
    public function __construct(
        protected UserRepository $repository
    )
    {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = $this->repository->all();
        return response()->json($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $data = new UserData($request->validated());
        $user = $this->repository->create($data->toArray());
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        $data = new UserDataUpdate($request->validated());
        $user = $this->repository->update($id, $data->toArray());
        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = $this->repository->delete($id);
        return response()->json($user);
    }
}
