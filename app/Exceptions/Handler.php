<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Validation\UnauthorizedException;
use Illuminate\Validation\ValidationException;
use Throwable;
use \Symfony\Component\HttpFoundation\Response as SymfonyResponse;

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
        \Log::alert($e->getCode());
        if ($e instanceof UnauthorizedException) {
            return apiResponseMessage(__('auth.failed'), SymfonyResponse::HTTP_UNAUTHORIZED);
        }

        if ($e instanceof AuthorizationException) {
            return apiResponseMessage(__('auth.must_login'), SymfonyResponse::HTTP_FORBIDDEN);
        }

        if ($e instanceof ValidationException) {
            return apiResponseMessage($e->errors(), SymfonyResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        if ($e instanceof ModelNotFoundException) {
            return apiResponseMessage(__('api.not_found_model'), SymfonyResponse::HTTP_NOT_FOUND);
        }

        // by default in api request
        return parent::render($request, $e);
    }

}
