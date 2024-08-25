<?php

namespace App\Http\Controllers\Customer\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\Profile\StoreRequest;
use App\Services\FileService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function uploadProfilePicture(StoreRequest $request): \Illuminate\Http\JsonResponse
    {
        try {

            $data = $request->validated();
            $customer = auth()->user();

            if ($request->hasFile('profile_picture')) {
                $fileService = new FileService($data['profile_picture']);
                $fileService->upload('customers/profiles');
                $data['profile_picture'] = $fileService->getPath();
                $customer->update(['profile_picture' => $data['profile_picture']]);
            }

            return response()->json([
                'message' => 'ok',
                'data' => $customer
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to upload profile picture.',
                'details' => $e->getMessage()
            ], 500);
        }
    }
}
