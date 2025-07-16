<?php

namespace App\Repositories;

use App\Models\NotarisDetail;
use App\Models\User;
use App\Repositories\Interfaces\NotarisDetailRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class NotarisDetailRepository implements NotarisDetailRepositoryInterface
{
    public function createWithDetails(array $data): bool
    {
        DB::beginTransaction();

        try {
            $user = User::create([
                'username' => $data['username'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'role_id' => 3,
            ]);

            if (isset($data['notaris_details'])) {
                NotarisDetail::create([
                    'user_id' => $user->user_id,
                    'nomor_jabatan_notaris' => $data['notaris_details']['nomor_jabatan_notaris'],
                    'nama_notaris' => $data['notaris_details']['nama_notaris'],
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

            if (isset($data['notaris_details'])) {
                NotarisDetail::updateOrCreate(
                    ['notaris_id' => $data['notaris_details']['notaris_id'] ?? null],
                    [
                        'user_id' => $id,
                        'nomor_jabatan_notaris' => $data['notaris_details']['nomor_jabatan_notaris'],
                        'nama_notaris' => $data['notaris_details']['nama_notaris'],
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
