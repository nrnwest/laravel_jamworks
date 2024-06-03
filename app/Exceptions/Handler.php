<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpFoundation\Response;
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

    public function render($request, Throwable $e)
    {
        if ($e instanceof BadRequestException) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }

        if ($e instanceof NotFoundException) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_NOT_FOUND);
        }

        if ($e instanceof InternalServerErrorException) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        if ($e instanceof ForbiddenException) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_FORBIDDEN);
        }

        if ($e instanceof UnauthorizedException) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_UNAUTHORIZED);
        }

        return parent::render($request, $e);
    }
}
