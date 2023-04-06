<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use RealRashid\SweetAlert\Facades\Alert;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $errorResponse;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (session('success')) {
                Alert::success(session('success'));
            }

            if (session('failed')) {
                Alert::error(session('failed'));
            }

            if (session("errors")) {

                $html = "<ul style='list-style: none;'>";
                foreach (session("errors")->getMessageBag()->getMessages() as $error) {
                    $html .= "<li  style='list-style: none;'>$error[0]</li>";
                }
                $html .= "</ul>";
                Alert::html('Error during action !', $html, 'error');
            }

            return $next($request);
        });
    }

    protected function isError(array $response, string $redirectRoute = null, array $params = []): bool
    {
        if (!$response["success"]) {
            if ($redirectRoute) {
                $this->setErrorResponse(
                    redirect()->route($redirectRoute, $params)->withErrors(["errors" => $response["message"]])->withInput()
                );
            } else {
                $this->setErrorResponse(
                    redirect()->back()->withErrors(["errors" => $response["message"]])->withInput()
                );
            }
            return true;
        }

        return false;
    }

    protected function getErrorResponse()
    {
        return $this->errorResponse;
    }

    protected function setErrorResponse($errorResponse): void
    {
        $this->errorResponse = $errorResponse;
    }
}
