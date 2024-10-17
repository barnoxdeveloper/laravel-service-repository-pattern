<?php

namespace BarnoxDev\ServiceRepositoryPattern\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class ServiceMakeCommand extends Command
{
    protected $signature = 'make:service {name}';
    protected $description = 'Create a service and service interface';

    public function handle()
    {
        $name = $this->argument('name');
        $files = new Filesystem;

        $servicePath = app_path("Services/{$name}/{$name}Service.php");
        $interfacePath = app_path("Services/{$name}/{$name}ServiceInterface.php");

        if (!$files->isDirectory(app_path("Services/{$name}"))) {
            $files->makeDirectory(app_path("Services/{$name}"), 0755, true);
        }

        $files->put($servicePath, "<?php

namespace App\Services\\{$name};

use App\Models\\{$name};

class {$name}Service implements {$name}ServiceInterface
{
    private \$model;

    public function __construct({$name} \$model)
    {
        \$this->model = \$model;
    }

    public function index() {}
    public function store() {}
    public function show() {}
    public function update() {}
    public function destroy() {}
}");

        $files->put($interfacePath, "<?php

namespace App\Services\\{$name};

interface {$name}ServiceInterface
{
    public function index();
    public function store();
    public function show();
    public function update();
    public function destroy();
}");

        $this->info("Service created at: {$servicePath}");
        $this->info("Service interface created at: {$interfacePath}");
    }
}
