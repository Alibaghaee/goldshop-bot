<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Composer;
use Illuminate\Support\Facades\Artisan;

class CreateModuleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:module
                    {name : Class (singular) for example User}
                    {--force : Overwrite existing views by default}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'make module';

    /**
     * Create a new failed queue jobs table command instance.
     *
     * @param  \Illuminate\Filesystem\Filesystem  $files
     * @param  \Illuminate\Support\Composer    $composer
     * @return void
     */
    public function __construct(Filesystem $files, Composer $composer)
    {
        parent::__construct();

        $this->files    = $files;
        $this->composer = $composer;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('name');

        $this->createModuleFiles($name);

        $this->addRoute($name);

        $this->registerVueTable($name);

        $this->RegisterSeeders($name);

        $this->makeMigration($name);

        $this->info('Module created successfully!');

        $this->composer->dumpAutoloads();

        \Cache::flush();
    }

    /**
     * get the given stub file content
     * @param  string $stub
     * @return string
     */
    protected function getStub($stub)
    {
        return $this->files->get(resource_path("stubs/module/$stub"));
    }

    /**
     * create module files for the given name
     * @param  string $name Class (singular) for example User
     * @return
     */
    protected function createModuleFiles($name)
    {
        $files = $this->getFiles($name);
        foreach ($files as $stub => $destination) {
            if (file_exists($destination) && !$this->option('force')) {
                if (!$this->confirm("The [{$destination}] view already exists. Do you want to replace it?")) {
                    continue;
                }
            }

            $this->createFile($name, $stub, $destination);
        }
    }

    /**
     * create file by the given info
     * @param  string $name module name
     * @param  string $dir  directory of stub file
     * @param  array $file stub file info
     * @return
     */
    public function createFile($name, $stub, $destination)
    {
        $template = $this->fillPlaceholders($name, $stub);

        $this->createDirectory($destination);

        $this->files->put($destination, $template);
    }

    /**
     * return stub files info and creation destination pathes
     * @param  string $name module name
     * @return array
     */
    public function getFiles($name)
    {
        $vueComponentPath = "/resources/assets/js/components/admin/modules/" . snake_case(str_plural($name)) . '/';
        $bladePath        = "/resources/views/admin/modules/" . snake_case(str_plural($name)) . "/";

        return [
            'php/Model.stub'              => app_path() . "/Models/General/{$name}.php",
            'php/Controller.stub'         => app_path() . "/Http/Controllers/General/{$name}Controller.php",
            'php/Resource.stub'           => app_path() . "/Http/Resources/{$name}/{$name}.php",
            'php/ResourceCollection.stub' => app_path() . "/Http/Resources/{$name}/{$name}Collection.php",
            'php/Filter.stub'             => app_path() . "/Filters/{$name}Filters.php",
            'php/DataSeeder.stub'         => base_path() . "/database/seeders/Data/" . str_plural($name) . "TableSeeder.php",
            'php/ModuleSeeder.stub'       => base_path() . "/database/seeders/Modules/{$name}ModuleTableSeeder.php",
            'vue/Table.stub'              => base_path() . $vueComponentPath . str_plural($name) . "Table.vue",
            'vue/FilterBar.stub'          => base_path() . "{$vueComponentPath}FilterBar.vue",
            'vue/FieldDefs.stub'          => base_path() . "{$vueComponentPath}FieldDefs.js",
            'vue/DetailRow.stub'          => base_path() . "{$vueComponentPath}DetailRow.vue",
            'blade/FormCreate.stub'       => base_path() . "{$bladePath}form_create.blade.php",
            'blade/FormEdit.stub'         => base_path() . "{$bladePath}form_edit.blade.php",
        ];
    }

    /**
     * fill the stub placeholders with the given name
     * @param  string $name
     * @param  string $stub
     * @return void
     */
    public function fillPlaceholders($name, $stub)
    {
        return str_replace(
            [
                '{{modelName}}',
                '{{modelNamePlural}}',
                '{{modelNamePluralLowerCase}}',
                '{{modelNameSingularLowerCase}}',
                '{{modelNameSingularKebabCase}}',
            ],
            [
                $name,
                str_plural($name),
                snake_case(str_plural($name)),
                snake_case($name),
                kebab_case($name),
            ],
            $this->getStub($stub)
        );
    }

    /**
     * Create the directories for the files.
     *
     * @return void
     */
    protected function createDirectory($filePath)
    {
        $directory = $this->files->dirname($filePath);

        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }
    }

    /**
     * make migration for the module
     * @param  string $name
     * @return void
     */
    protected function makeMigration($name)
    {
        Artisan::call('make:migration', [
            'name'     => 'create_' . snake_case($name) . '_module',
            '--create' => snake_case(str_plural($name)),
        ]);
    }

    /**
     * add module route to the web route file
     *
     * @return void
     */
    protected function addRoute($name)
    {
        $route = $this->fillPlaceholders($name, 'php/Route.stub');

        $web = str_replace_first(
            '// {{dont_delete_this_comment}}',
            $route,
            $this->getRoutContent()
        );

        $this->files->put($this->getRoutPath(), $web);
    }

    /**
     * add module route to the web route file
     *
     * @return void
     */
    protected function registerVueTable($name)
    {
        $vueTable = $this->fillPlaceholders($name, 'vue/RegisterVueTable.stub');

        $appJs = str_replace_first(
            '// {{dont_delete_this_comment}}',
            $vueTable,
            $this->getAppJsContent()
        );

        $this->files->put($this->getAppJsPath(), $appJs);
    }

    /**
     * register seeders in DatabaseSeeder.php
     *
     * @return void
     */
    protected function RegisterSeeders($name)
    {
        $databaseSeeder = str_replace(
            [
                '// {{dont_delete_this_comment_one}}',
                '// {{dont_delete_this_comment_two}}',
                '// {{dont_delete_this_comment_three}}',
                '// {{dont_delete_this_comment_four}}',
            ],
            [
                'use Data\\' . str_plural($name) . 'TableSeeder;' . "\n" . '// {{dont_delete_this_comment_one}}',
                'use Modules\\' . $name . 'ModuleTableSeeder;' . "\n" . '// {{dont_delete_this_comment_two}}',
                '$this->call(' . $name . 'ModuleTableSeeder::class);' . "\n" . '        // {{dont_delete_this_comment_three}}',
                '$this->call(' . str_plural($name) . 'TableSeeder::class);' . "\n" . '        // {{dont_delete_this_comment_four}}',
            ],
            $this->getDatabaseSeederContent()
        );

        $this->files->put($this->getDatabaseSeederPath(), $databaseSeeder);
    }

    /**
     * get the web route file content
     *
     * @return string
     */
    protected function getRoutContent()
    {
        return $this->files->get($this->getRoutPath());
    }

    /**
     * get the web route file path
     *
     * @return string
     */
    protected function getRoutPath()
    {
        return base_path() . "/routes/web.php";
    }

    /**
     * get the app.js file content
     *
     * @return string
     */
    protected function getAppJsContent()
    {
        return $this->files->get($this->getAppJsPath());
    }

    /**
     * get the app js file path
     *
     * @return string
     */
    protected function getAppJsPath()
    {
        return base_path() . "/resources/assets/js/app.js";
    }

    /**
     * get the app.js file content
     *
     * @return string
     */
    protected function getDatabaseSeederContent()
    {
        return $this->files->get($this->getDatabaseSeederPath());
    }

    /**
     * get the app js file path
     *
     * @return string
     */
    protected function getDatabaseSeederPath()
    {
        return base_path() . "/database/seeders/DatabaseSeeder.php";
    }

}
