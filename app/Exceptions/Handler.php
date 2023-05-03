<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Auth\AuthenticationException;
class Handler extends ExceptionHandler
{
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
        'password',
        'password_confirmation',
    ];


    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof ModelNotFoundException && $request->expectsJson()) {
            return response()->json(['status' => false, 'code' => 203, 'message' =>__('api.not_found')]);

        }

        if ($exception instanceof \Illuminate\Foundation\Http\Exceptions\MaintenanceModeException && $request->expectsJson()) {
            return response()->json(['status' => false, 'code' => 503, 'message' =>__('api.not_found')]);
        }

        return parent::render($request, $exception);
    }


    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if($request->ajax()){

        }
        if ($request->expectsJson()) {
            return response()->json(['status' => false, 'code' => 401, 'message' =>__('api.unauthenticated')]);
            
                }
        if (in_array('admin', explode('/', request()->url()))) {
            return redirect('/admin/login');
        }elseif (in_array('subadmin', explode('/', request()->url()))) {
            return redirect('subadmin/login');
        }else{
            return redirect('/login');
        }
        return response()->json(['status' => false, 'code' => 401, 'message' =>__('api.unauthenticated')]);

        $guards = array_get($exception->guards() ,0);

        switch ($guards) {
            case 'admin':
                $login = 'admin.login';
                break;

            case 'subadmin':
                $login = 'subadmin.login';
                break;

            default:
                $login = 'login';
                break;
        }



        //return mainResponse(false, 'api.unauthenticated', [], 401,'','');

//        return mainResponse(false, 'api.unauthenticated', [], []);
//        return response()->json(['status' => false ,'message' => __('api.unauthenticated') ]);
    }

    
    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
