<?php

namespace BarnoxDev\ServiceRepositoryPattern\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class RepositoryMakeCommand extends Command
{
    protected $signature = 'make:repository {name}';
    protected $description = 'Create a repository and repository interface';

    public function handle()
    {
        $name = $this->argument('name');
        $files = new Filesystem;

        $repositoryPath = app_path("Repositories/{$name}/{$name}Repository.php");
        $interfacePath = app_path("Repositories/{$name}/{$name}RepositoryInterface.php");

        if (!$files->isDirectory(app_path("Repositories/{$name}"))) {
            $files->makeDirectory(app_path("Repositories/{$name}"), 0755, true);
        }

        $files->put($repositoryPath, "<?php

namespace App\Repositories\\{$name};

class {$name}Repository implements {$name}RepositoryInterface
{
    private \$repository;

    public function __construct({$name}RepositoryInterface \$repository)
    {
        \$this->repository = \$repository;
    }

    public function index() {}
    public function store() {}
    public function show() {}
    public function update() {}
    public function destroy() {}
}");

        $files->put($interfacePath, "<?php

namespace App\Repositories\\{$name};

interface {$name}RepositoryInterface
{
    public function index();
    public function store();
    public function show();
    public function update();
    public function destroy();
}");

        $this->info("Repository created at: {$repositoryPath}");
        $this->info("Repository interface created at: {$interfacePath}");
    }
}
