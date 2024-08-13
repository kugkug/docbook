<?php

namespace App\Http\Middleware;

use App\Helpers\GlobalHelper;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //Get User Type

        $user = Auth::user();
        $user_type = $user->user_type;
        $user_id = $user->id;

        if ($user_type) {
            switch($user_type) {
                case User::USER_TYPE['admin'] : 
                        $tbl_provider_id = '';
                        $tbl_creator_id = Auth::id();
                    break;

                case User::USER_TYPE['provider'] : 
                case User::USER_TYPE['therapist'] : 
                        $tbl_provider_id = '';
                        $tbl_creator_id = '';
                    break;
                    
                case User::USER_TYPE['user'] : 
                case User::USER_TYPE['staff'] : 

                    // $parent_id = 
                break;

                default:
                    GlobalHelper::errorResponse([
                        'status' => 'error',
                        'message' => 'Forbidden!'
                    ], 403);
                    break;
            }
        } else {
            GlobalHelper::errorResponse([
                'status' => 'error',
                'message' => 'Forbidden!'
            ], 403);
        }
        
        return $next($request);
    }
}