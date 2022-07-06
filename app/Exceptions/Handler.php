<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use \Illuminate\Database\Eloquent\ModelNotFoundException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof ModelNotFoundException && $request->wantsJson()) {
            return response()->json([
                'message' => 'Resource not found'
            ], 404);
        }

        if( $exception instanceof  \Symfony\Component\HttpKernel\Exception\NotFoundHttpException ) {
            return response()->json([
                'error' => 'Resource not found'
            ], 404);
        }

        if( $exception instanceof  \Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException ) {
            return response()->json([
                'error' => 'Method is not allowed for the requested route'
            ], 405);
        }

        return parent::render($request, $exception);
    }
}
