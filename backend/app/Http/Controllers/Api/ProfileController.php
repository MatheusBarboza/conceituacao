<?php

namespace App\Http\Controllers\Api;

use App\DataTransferObjects\Profile\ProfileData;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProfileRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Repositories\ProfileRepository;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct(
        protected ProfileRepository $repository
    )
    {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profiles = $this->repository->all();
        return response()->json($profiles);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProfileRequest $request)
    {
        $data = new ProfileData($request->validated());
        $profile = $this->repository->create($data->toArray());
        return response()->json($profile);
    }

    public function show(string $id)
    {
        $profile = $this->repository->find($id);
        return response()->json($profile);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProfileRequest $request, string $id)
    {
        $data = new ProfileData($request->validated());
        $profile = $this->repository->update($id, $data->toArray());
        return response()->json($profile);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $profile = $this->repository->delete($id);
        return response()->json($profile);
    }
}
