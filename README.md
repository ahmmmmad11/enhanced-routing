# inhanced-routing

extends Laravel routing package to add more functionality, For this version we provide the ability to allow multiple explicit route binding fields.

## Installation

    composer required ahmmmmad11/inhanced-routing
  
Now open `config/app.php` and add the service provider to your providers array.

    'providers' => [
    /*
     * Package Service Providers...
     */
     
     \Ahmmmmad11\Routing\RoutingServiceProvider::class,
    ]
  
then go to `app/Http/Kernal` and add the follwing code

    //import Router class and Application Interface
    use Ahmmmmad11\Routing\Router;
    use Illuminate\Contracts\Foundation\Application;
    
    // add this constructer inside Kernal class
    public function __construct(Application $app, Router $router)
    {
        $this->app = $app;
        $this->router = $router;

        $this->syncMiddlewareToRouter();
    }
    
## usage

if you successfully intalled the package now you can bind multiple fields to the route

    Route::get('users/{user:email,username,id}', function(User $user) {
        return $user;
    });
    
now you can access this route in many ways, like:

    // http://127.0.0.1:8000/users/1
    or
    // http://127.0.0.1:8000/users/firstuser@example.com
    or
    // http://127.0.0.1:8000/users/firstuser
    
> **warning**  
> please allways place numeric fields (`int`, `float` and ...) as the last options for example do `{user:email,username,id}` not `{user:id,email,username}`
