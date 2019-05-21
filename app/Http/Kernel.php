<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            //\App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            'throttle:60,1',
            'bindings',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
		
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
		
		//Middleware для пользователя
		//авторизован ли пользователь
		'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
		//существуют ли у пользователя чек листы
		'isNotEmpty' => \App\Http\Middleware\isNotEmptyDateMiddleware::class,
		//существую ли у чек листа пункты
		'isNotEmptyList' => \App\Http\Middleware\isNotEmptyListMiddleware::class,
		//существует ли чек лист с конкретным id
		'isList' => \App\Http\Middleware\isListMiddleware::class,
		//существует ли пункт листа с конкретным id
		'isItem' => \App\Http\Middleware\isItemMiddleware::class,
		//не превышен ли лимит возможного количества записей
		'limitCount' => \App\Http\Middleware\limitCountListMiddleware::class,
		//не заблокирован ли пользователь
		'isBlock' => \App\Http\Middleware\isBlockMiddleware::class,
		
		//Middleware для администратора
		//является ли пользователь главным администратором
		'admin1' => \App\Http\Middleware\adminMiddleware::class,
		//является ли пользователь администратором
		'admin2' => \App\Http\Middleware\admin2Middleware::class,
		//существую ли в системе чек листы
		'adminIsNotEmpty' => \App\Http\Middleware\adminIsNotEmptyDateMiddleware::class,
		//существует ли чек лист с конкретным id
		'adminIsList' => \App\Http\Middleware\adminIsListMiddleware::class,
		//существую ли у чек листа пункты
		'adminIsNotEmptyList' => \App\Http\Middleware\adminIsNotEmptyListMiddleware::class,
		//имеется ли в таблице чек листов конкретное поле для сортировки
		'adminSort' => \App\Http\Middleware\adminSortMiddleware::class,
		//существуют ли у конкретного пользователя чек листы
		'adminUserList' => \App\Http\Middleware\adminUserListMiddleware::class,
		//существует ли пользователь с конкретным ID
		'hasUser' => \App\Http\Middleware\adminIsUserMiddleware::class,
		//является ли пользователь, которого пытаются заблокировать, администратором
		'userIsAdmin' => \App\Http\Middleware\UserIsAdminMiddleware::class
	];
}
