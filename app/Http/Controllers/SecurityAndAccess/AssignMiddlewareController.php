<?php

namespace App\Http\Controllers\SecurityAndAccess;

use App\Http\Controllers\Controller;
use App\Models\SecurityAndAccess\Middleware;
use App\Models\SecurityAndAccess\ModuleLink;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AssignMiddlewareController extends Controller
{
    public function assignMiddlewareToRoute()
    {
        $middlewareAssign = [];
        $middAssign = [];
        $routeAssign = [];
        $rAssign = [];
        $routeForMiddleware = [];
        $middlewareForRoute = [];
        $routes = ModuleLink::all();
        $middlewares = Middleware::all();

        $routeFromFile = file_get_contents(storage_path('php/cache/route.php'));
        // Extract the $routes array from the file content
        // Remove the PHP tags
        $routeFromFile = trim($routeFromFile);
        $routeFromFile = preg_replace('/^<\?php/', '', $routeFromFile);
        // Use eval() to execute the PHP code and define the $routes array
        eval($routeFromFile);

        $filesystem = new Filesystem();
        $middlewareFromFile = $filesystem->get(storage_path('php/cache/middleware.txt'));
        // Extract the $routes array from the file content
        // Remove the PHP tags
        $middlewareFromFile = trim($middlewareFromFile);
        // $middlewareFromFile = preg_replace('/^<\?php/', '', $middlewareFromFile);
        // Use eval() to execute the PHP code and define the $routes array
        eval($middlewareFromFile);

        foreach ($routeForMiddleware as $linkId) {
            $middlewareAssign = ModuleLink::select('id', 'name', 'middlewares')->where('id', $linkId['routeId'])->get();
            foreach ($middlewareAssign as $ma) {
                $middAssign[] = $ma;
            }
        }

        foreach ($middlewareForRoute as $middId) {
            $routeAssign = Middleware::select('id', 'name', 'route_id')->where('id', $middId['middlewareId'])->get();
            foreach ($routeAssign as $ra) {
                $rAssign[] = $ra;
            }
        }

        return view("security_and_access.middleware.assign_middleware", ['routes' => $routes, 'middlewares' => $middlewares, 'middlewareAssign' => $middAssign, 'routeAssign' => $rAssign]);
    }

    public function addRoute()
    {
        $add_middleware = request('add_middleware');
        $middleware_id = request('middleware_id');
        if ($add_middleware) {
            $fileContents = file_get_contents(storage_path('php/cache/middleware.txt'));
            try {
                $newMiddleware =
                    "[
                  'middlewareId' => '$middleware_id',
                  ],";

                $newFileContent = preg_replace('/\];\s*$/', $newMiddleware . "\n];", $fileContents);
                // Read the contents of the middleware.txt file
                $fileContents = file_get_contents(storage_path('php/cache/middleware.txt'));
                file_put_contents(
                    storage_path('php/cache/middleware.txt'),
                    $newFileContent
                );
                return redirect()->route('securityandaccess.assign-middleware');
            } catch (\Exception $e) {
                return redirect()->back()->with("error", $e . " Something want wrong!, please try again");
            }
        } else {
            $routeId = request('route_id');
            $fileContents = file_get_contents(storage_path('php/cache/route.php'));
            try {
                $newRoute =
                    "[
                                    'routeId' => '$routeId',
                                    ],";

                $newFileContent = preg_replace('/\];\s*$/', $newRoute . "\n];", $fileContents);
                // Read the contents of the route.php file
                $fileContents = file_get_contents(storage_path('php/cache/route.php'));
                file_put_contents(
                    storage_path('php/cache/route.php'),
                    $newFileContent
                );
                return redirect()->route('securityandaccess.assign-middleware');
            } catch (\Exception $e) {
                return redirect()->back()->with("error", $e . " Something want wrong!, please try again");
            }
        }
    }


    public function removeRoute()
    {
        $middlewareAssign = [];
        $middAssign = [];
        $routeAssign = [];
        $rAssign = [];
        $routeForMiddleware = [];
        $middlewareForRoute = [];
        $routes = ModuleLink::all();
        $middlewares = Middleware::all();

        $remove_middleware = request('remove_middleware');

        if ($remove_middleware) {
            $middId = request('midd_id');

            $fileContents = file_get_contents(storage_path('php/cache/middleware.txt'));
            $fileContents = trim($fileContents);
            // Use eval() to execute the PHP code and define the $routes array
            eval($fileContents);
            if (isset($middlewareForRoute) && is_array($middlewareForRoute)) {
                // Find and remove the element with routeId 66
                foreach ($middlewareForRoute  as $key => $route) {
                    if ($route['middlewareId'] == $middId) {
                        unset($middlewareForRoute[$key]);
                    }
                }

                // Re-index the array to ensure it is correctly formatted
                $middlewareForRoute  = array_values($middlewareForRoute);
                // Convert the updated array to a PHP code string
                $arrayString = "<?php\n\$middlewareForRoute  = " . var_export($middlewareForRoute, true) . ";\n";
                // Formatting to make it more readable
                $arrayString = str_replace("array (", "[", $arrayString);
                $arrayString = str_replace(")", "]", $arrayString);
                $arrayString = str_replace("=> \n  [", "=> [", $arrayString);
                // Remove the numeric keys
                $arrayString = preg_replace('/\d+ => /', '', $arrayString);
                $arrayString = str_replace("<?php\n", "", $arrayString);
                // Save the string to a file
                file_put_contents(storage_path('php/cache/middleware.txt'), $arrayString);
            }
        } else {
            $routeId = request('link_id');
            $fileContents = file_get_contents(storage_path('php/cache/route.php'));
            $fileContents = trim($fileContents);
            // Remove the PHP tags
            $fileContents = preg_replace('/^<\?php/', '', $fileContents);
            // Use eval() to execute the PHP code and define the $routes array
            eval($fileContents);
            if (isset($routeForMiddleware) && is_array($routeForMiddleware)) {
                // Find and remove the element with routeId 66
                foreach ($routeForMiddleware as $key => $route) {
                    if ($route['routeId'] == $routeId) {
                        unset($routeForMiddleware[$key]);
                    }
                }

                // Re-index the array to ensure it is correctly formatted
                $routeForMiddleware = array_values($routeForMiddleware);

                // Convert the updated array to a PHP code string
                $arrayString = "<?php\n\$routeForMiddleware = " . var_export($routeForMiddleware, true) . ";\n";

                // Formatting to make it more readable
                $arrayString = str_replace("array (", "[", $arrayString);
                $arrayString = str_replace(")", "]", $arrayString);
                $arrayString = str_replace("=> \n  [", "=> [", $arrayString);
                // Remove the numeric keys
                $arrayString = preg_replace('/\d+ => /', '', $arrayString);

                // Save the string to a file
                file_put_contents(storage_path('php/cache/route.php'), $arrayString);
            }
        }

        $filesystem = new Filesystem();
        $middlewareFromFile = $filesystem->get(storage_path('php/cache/middleware.txt'));
        // Extract the $routes array from the file content
        // Remove the PHP tags
        $middlewareFromFile = trim($middlewareFromFile);
        // $middlewareFromFile = preg_replace('/^<\?php/', '', $middlewareFromFile);
        // Use eval() to execute the PHP code and define the $routes array
        eval($middlewareFromFile);

        foreach ($middlewareForRoute  as $midId) {
            $routeAssign = Middleware::select('id', 'name')->where('id', $midId['middlewareId'])->get();
            foreach ($routeAssign as $ra) {
                $rAssign[] = $ra;
            }
        }

        $routeFromFile = file_get_contents(storage_path('php/cache/route.php'));
        // Extract the $routes array from the file content
        // Remove the PHP tags
        $routeFromFile = trim($routeFromFile);
        $routeFromFile = preg_replace('/^<\?php/', '', $routeFromFile);
        // Use eval() to execute the PHP code and define the $routes array
        eval($routeFromFile);

        foreach ($routeForMiddleware as $linkId) {
            $middlewareAssign = ModuleLink::select('id', 'name', 'middlewares')->where('id', $linkId['routeId'])->get();
            foreach ($middlewareAssign as $ma) {
                $middAssign[] = $ma;
            }
        }
        return view("security_and_access.middleware.assign_middleware", ['routes' => $routes, 'middlewares' => $middlewares, 'middlewareAssign' => $middAssign, 'routeAssign' => $rAssign]);
    }

    public function addMiddleware()
    {
        $add_middleware = request('add_middleware');
        if ($add_middleware) {
            $middleware_id = request('middleware_id');
            $route_id = request('route_id');
            $middleware = Middleware::find($middleware_id);
            $exRoute = $middleware->route_id;
            if ($exRoute) {
                $middleware->route_id = $exRoute . ', ' . $route_id;
            } else {
                $middleware->route_id = $route_id;
            }
            $middleware->save();

            $route = ModuleLink::find($route_id);
            $exMiddleware = $route->middlewares;
            if ($exMiddleware) {
                $route->middlewares = $exMiddleware . ', ' . $middleware->name;
            } else {
                $route->middlewares = $middleware->name;
            }
            $route->save();

            return redirect()->route('securityandaccess.assign-middleware');
        } else {
            $route_id = request('route_id');
            $middleware_data = request('middleware_data');
            $middlewareData = explode('/', $middleware_data);
            $middleware_name = $middlewareData[0];
            $middleware_id = $middlewareData[1];

            $route = ModuleLink::find($route_id);
            $exMiddleware = $route->middlewares;
            if ($exMiddleware) {
                $route->middlewares = $exMiddleware . ', ' . $middleware_name;
            } else {
                $route->middlewares = $middleware_name;
            }
            $route->save();

            $middleware = Middleware::find($middleware_id);
            $exRoute = $middleware->route_id;
            if ($exRoute) {
                $middleware->route_id = $exRoute . ', ' . $route_id;
            } else {
                $middleware->route_id = $route_id;
            }
            $middleware->save();

            return redirect()->route('securityandaccess.assign-middleware');
        }
    }

    public function removeMiddleware(Request $request)
    {

        $remove_middleware = $request->input('remove_middleware');
        $ex_route = $request->input('ex_route');
        $middleware_id = $request->input('middleware_id');
        if ($remove_middleware) {

            //  dd($middleware_id);
            $middleware = Middleware::find($middleware_id);
            $exRoute = $middleware->route_id;
            $position = Str::position($exRoute, ',');
            if ($position == false) {
                $middleware->route_id = NULL;
                $middleware->save();
            } else {
                $removed = Str::remove(', ' . $ex_route, $exRoute);
                $removed2 = Str::remove($ex_route . ',' . ' ', $exRoute);
                if ($removed == $exRoute) {
                    $remove = $removed2;
                } elseif ($removed2 == $exRoute) {
                    $remove = $removed;
                } else {
                    $remove = $removed;
                }
                $middleware->route_id = $remove;
                $middleware->save();
            }
            return redirect()->route('securityandaccess.assign-middleware');
        } else {
            $route_id = $request->input('route_id');
            $ex_middleware = $request->input('ex_middleware');
            $route = ModuleLink::find($route_id);
            $exMiddleware = $route->middlewares;
            $position = Str::position($exMiddleware, ',');
            if ($position == false) {
                $route->middlewares = NULL;
                $route->save();
            } else {
                $removed = Str::remove(', ' . $ex_middleware, $exMiddleware);
                $removed2 = Str::remove($ex_middleware . ',' . ' ', $exMiddleware);
                if ($removed == $exMiddleware) {
                    $remove = $removed2;
                } elseif ($removed2 == $exMiddleware) {
                    $remove = $removed;
                } else {
                    $remove = $removed;
                }
                $route->middlewares = $remove;
                $route->save();
            }
            return redirect()->route('securityandaccess.assign-middleware');
        }
    }

    public function assign()
    {
        $filesystem = new Filesystem();
        $filesystem->put(storage_path('php/cache/route.php'), '<?php
        $routeForMiddleware = [
        ];');
        $filesystem->put(storage_path('php/cache/middleware.txt'), '
        $middlewareForRoute = [
        ];');
        return redirect()->route('securityandaccess.assign-middleware')->with('success', 'Middleware assign successfully!');
    }
}
