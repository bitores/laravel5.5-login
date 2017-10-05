composer create-project laravel/larvel  项目名 --prefer-dist
composer self-update
composer config -l -g
查找路径，修改更新地址


npm install
composer install


Yajra\DataTables\HtmlServiceProvider::class,
Yajra\DataTables\ButtonsServiceProvider::class,
Yajra\DataTables\DataTablesServiceProvider::class,

'DataTables' => Yajra\DataTables\Facades\DataTables::class,


php artisan vendor:publish --tag=datatables-buttons --force
php artisan vendor:publish --tag=datatables-html
php artisan vendor:publish --provider=Yajra\DataTables\DataTablesServiceProvider


SocialiteProviders\Manager\ServiceProvider::class,
'Socialite' => Laravel\Socialite\Facades\Socialite::class,

添加事件监听器（App/Providers/EventServiceProvider）：

protected $listen = [
    'SocialiteProviders\Manager\SocialiteWasCalled' => [
        'SocialiteProviders\Weibo\WeiboExtendSocialite@handle',
    ],
];


Rap2hpoutre\LaravelLogViewer\LaravelLogViewerServiceProvider::class,

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

php artisan vendor:publish --provider="Rap2hpoutre\LaravelLogViewer\LaravelLogViewerServiceProvider" --tag=views



创建登录、注册视图
php artisan make:auth


web.php 添加视图路由控制
Auth::routes();

添加 中间件
Authenticate.php  登录认证-登录成功或失败
CheckCurrentUser.php 未认证用户- 是否登录
CheckUserActivated.php 激活用户 - 是否成功激活

Kernel.php 中注册中间件

$middlewareGroups: 

'activated' => [
    CheckIsUserActivated::class,
],


$routeMiddleware:

'activated'     => CheckIsUserActivated::class,
'role'          => \jeremykenedy\LaravelRoles\Middleware\VerifyRole::class,
'permission'    => \jeremykenedy\LaravelRoles\Middleware\VerifyPermission::class,
'level'         => \jeremykenedy\LaravelRoles\Middleware\VerifyLevel::class,
'currentUser'   => \App\Http\Middleware\CheckCurrentUser::class,



据表自动生成 数据库迁移表
composer require --dev "xethron/migrations-generator"

The recommended way to install this is through composer:

composer require --dev "xethron/migrations-generator"
In Laravel 5.5 the service providers will automatically get registered.

In older versions of the framework edit config/app.php and add this to providers section:

Way\Generators\GeneratorsServiceProvider::class,
Xethron\MigrationsGenerator\MigrationsGeneratorServiceProvider::class,

Run 
php artisan migrate:generate