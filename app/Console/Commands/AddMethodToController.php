<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class AddMethodToController extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:method {controller} {method}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add a new method to an existing controller';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $controller = $this->argument('controller');
        $method = $this->argument('method');

        $filesystem = new Filesystem();

        $controllerPath = app_path("Http/Controllers/{$controller}.php");

        if (!$filesystem->exists($controllerPath)) {
            $this->error("Controller does not exist.");
            return 1;
        }

        $controllerContent = $filesystem->get($controllerPath);

        $methodTemplate = $this->getMethodTemplate($method, $controller);

        // Insert the method template before the last closing brace of the controller
        $newControllerContent = preg_replace(
            '/}\s*$/',
            "\n    $methodTemplate\n}",
            $controllerContent
        );

        $filesystem->put($controllerPath, $newControllerContent);

        $this->info("Method {$method} added to {$controller} successfully.");
        return 0;
    }

    /**
     * Get the template for the new method.
     *
     * @param string $method
     * @return string
     */
    protected function getMethodTemplate($method, $controller)
    {
        return "public function {$method}()\n    {\n        echo 'from {$controller} {$method} method';\n    }";
    }
}
