<?php

namespace App\Services\Auth;

use App\Jobs\SendForgotPasswordMailJob;
use App\Repositories\PasswordResetRepository;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Iqbalatma\LaravelServiceRepo\BaseService;

class ForgotPasswordService extends BaseService
{
    protected $repository;
    protected $userRepo;

    public function __construct()
    {
        $this->repository = new PasswordResetRepository();
        $this->userRepo = new UserRepository();
    }
    /**
     * Description : use to get all data for forgot view
     *
     * @return array
     */
    public function getForgotData(): array
    {
        return [
            "title" => "Forgot Password",
        ];
    }

    /**
     * Description : use to get all data for reset view
     *
     * @return array
     */
    public function getResetData(string $token, string $email): array
    {
        return [
            "title" => "Reset Password",
            "token" => $token,
            "email" => $email,
        ];
    }

    /**
     * Description : use to reset password
     *
     * @param array $requestedData email from reset password
     */
    public function sendResetRequest(array $requestedData): bool
    {
        $resetData = [
            "email"      => $requestedData["email"],
            "token"      => Str::random(40),
            "created_at" => Carbon::now(),
        ];

        try {
            DB::beginTransaction();
            $user = (new UserRepository())->getDataUserByEmail($requestedData["email"]);
            if (!$user) {
                return false;
            }
            $this->repository->deleteDataPasswordResetByEmail($requestedData["email"]);

            $reset = $this->repository->addNewDataPasswordReset($resetData);
            dispatch(new SendForgotPasswordMailJob($reset));

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return false;
        }
        return true;
    }

    public function resetPassword(array $requestedData): bool
    {
        try {
            DB::beginTransaction();
            $isTokenValid = $this->repository->getDataPasswordResetByEmailToken(["email" => $requestedData["email"], "token" => $requestedData["token"]]);

            if (!$isTokenValid) {
                return false;
            }

            $updated = $this->userRepo->updateDataUserByEmail($requestedData["email"], ["password" => Hash::make($requestedData["password"])]);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return false;
        }

        return $updated;
    }
}
