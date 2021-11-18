<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Access\AuthorizationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use App\Traits\ApiResponser;
use Throwable;

class Handler extends ExceptionHandler
{
    use ApiResponser;
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
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
       
         $this->renderable(function (ModelNotFoundException $e, $request) {

            if ($request->expectsJson()) {
                $modelName = strtolower(class_basename($e->getModel()));

                return $this->errorResponse("Does not exists any {$modelName} with the specified indentificator", 422);
            }
            
        });

         $this->renderable(function (AuthenticationException $e, $request) {

            if ($request->expectsJson()) {
                return $this->errorResponse('Unauthenticated!!', 401);
            }
            
        });

        $this->renderable(function (AuthorizationException $e, $request) {

            if ($request->expectsJson()) {
                return $this->errorResponse($e->getMessage(), 403);
            }
            
        });

        $this->renderable(function (NotFoundHttpException $e, $request) {

            if ($request->expectsJson()) {
                return $this->errorResponse('The specified URL cannot be found', 404);
            }
            
        });

        $this->renderable(function (MethodNotAllowedHttpException $e, $request) {
            
            if ($request->expectsJson()) {
               return $this->errorResponse('The specified method for the request is invalid', 405);
            }
            
        });
       
       $this->renderable(function (HttpException $e, $request) {
            
            if ($request->expectsJson()) {
               return $this->errorResponse($e->getMessage(), $e->getStatusCode());
            }
            
        });

       $this->renderable(function (ValidationException $e, $request) {
            
            if ($request->expectsJson()) {
                return $this->errorResponse($e->errors(), 422);
            }
            
        });

       $this->renderable(function (QueryException $e, $request) {
            
            if ($request->expectsJson()) {
                $errorCode = $e->errorInfo[1];
                if ($errorCode == 1451) {
                    return $this->errorResponse('Cannot delete resource permanently. It is related with any other resource', 409);
                }
            }
            
        });    
    }
}
