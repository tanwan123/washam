protected $routeMiddleware = [
 'admin' => \App\Http\Middleware\AdminMiddleware::class,
 'collector' => \App\Http\Middleware\CollectorMiddleware::class,

];

