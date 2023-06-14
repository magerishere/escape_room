<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\UnauthorizedException;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });

    }

    public function render($request, Throwable $e): JsonResponse|RedirectResponse|Response|\Symfony\Component\HttpFoundation\Response
    {
        if (!isApiRequest($request)) {
            return parent::render($request, $e);
        }

        if ($e instanceof UnauthorizedException) {
            return apiResponseMessage(__('auth.failed'));
        }

        if ($e instanceof AuthorizationException) {
            return apiResponseMessage(__('auth.must_login'));
        }

        if ($e instanceof ValidationException) {
            return apiResponseMessage($e->errors());
        }

        // by default in api request
        return apiResponseMessage($e->getMessage());
    }

}
