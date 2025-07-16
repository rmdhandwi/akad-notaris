<?php

namespace App\Repositories;

use App\Models\StafDetail;
use App\Models\User;
use App\Repositories\Interfaces\StafDetailRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StafDetailRepository implements StafDetailRepositoryInterface
{
    public function createWithDetails(array $data): bool
    {
        DB::beginTransaction();

        try {
            $user = User::create([
                'username' => $data['username'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'role_id' => 2,
            ]);

            if (isset($data['staf_details'])) {
                StafDetail::create([
                    'user_id' => $user->user_id,
                    'nik_staf' => $data['staf_details']['nik_staf'],
                    'nama_staf' => $data['staf_details']['nama_staf'],
                ]);
            }

            DB::commit();
            return true;
        } catch (\Throwable $e) {
            DB::rollBack();
            return false;
        }
    }

    public function update($id, array $data)
    {
        DB::beginTransaction();

        try {
            $user = User::findOrFail($id);

            $user->update([
                'username' => $data['username'],
                'email' => $data['email'],
            ]);

            // Update password hanya jika diisi
            if (!empty($data['password'])) {
                $user->update(['password' => Hash::make($data['password'])]);
            }

            if (isset($data['staf_details'])) {
                StafDetail::updateOrCreate(
                    ['staf_id' => $data['staf_details']['staf_id'] ?? null],
                    [
                        'user_id' => $id,
                        'nik_staf' => $data['staf_details']['nik_staf'],
                        'nama_staf' => $data['staf_details']['nama_staf'],
                    ]
                );
            }

            DB::commit();
            return true;
        } catch (\Throwable $e) {
            DB::rollBack();
            return false;
        }
    }

    public function delete($id)
    {
        $getUser = User::findOrFail($id);

        return $getUser->delete();
    }
}
