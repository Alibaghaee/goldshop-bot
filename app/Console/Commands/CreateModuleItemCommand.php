<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Composer;
use Illuminate\Support\Facades\Artisan;

class CreateModuleItemCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:items-module
                    {child : Class (singular) for example CategoryItem}
                    {parent : Class (singular) for example Category}
                    {--force : Overwrite existing views by default}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'make items module';

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
        $child = $this->argument('child');

        $parent = $this->argument('parent');

        $this->createModuleFiles($child, $parent);

        $this->addRoute($child, $parent);

        $this->registerVueTable($child, $parent);

        $this->RegisterSeeders($child);

        $this->appendParentModel($child, $parent);

        // $this->makeMigration($child);

        $this->info('Items Module created successfully!');

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
        return $this->files->get(resource_path("$stub"));
    }

    /**
     * create module files for the given child
     * @param  string $child Class (singular) for example User
     * @return
     */
    protected function createModuleFiles($child, $parent)
    {
        $files = $this->getFiles($child);
        foreach ($files as $stub => $destination) {
            if (file_exists($destination) && !$this->option('force')) {
                if (!$this->confirm("The [{$destination}] view already exists. Do you want to replace it?")) {
                    continue;
                }
            }

            $this->createFile($child, $parent, $stub, $destination);
        }
    }

    /**
     * create file by the given info
     * @param  string $child module child
     * @param  string $dir  directory of stub file
     * @param  array $file stub file info
     * @return
     */
    public function createFile($child, $parent, $stub, $destination)
    {
        $template = $this->fillPlaceholders($child, $parent, $stub);

        $this->createDirectory($destination);

        $this->files->put($destination, $template);
    }

    /**
     * return stub files info and creation destination pathes
     * @param  string $child module child
     * @return array
     */
    public function getFiles($child)
    {
        $vueComponentPath = "/resources/assets/js/components/admin/modules/" . snake_case(str_plural($child)) . '/';
        $bladePath        = "/resources/views/admin/modules/" . snake_case(str_plural($child)) . "/";

        return [
            'stubs/module_items/php/Model.stub'        => app_path() . "/Models/General/{$child}.php",
            'stubs/module_items/php/Controller.stub'   => app_path() . "/Http/Controllers/General/{$child}Controller.php",
            'stubs/module_items/php/Resource.stub'     => app_path() . "/Http/Resources/{$child}/{$child}.php",
            'stubs/module/php/ResourceCollection.stub' => app_path() . "/Http/Resources/{$child}/{$child}Collection.php",
            'stubs/module/php/Filter.stub'             => app_path() . "/Filters/{$child}Filters.php",
            'stubs/module/php/DataSeeder.stub'         => base_path() . "/database/seeders/Data/" . str_plural($child) . "TableSeeder.php",
            // 'stubs/module/php/ModuleSeeder.stub'       => base_path() . "/database/seeders/Modules/{$child}ModuleTableSeeder.php",
            'stubs/module_items/vue/Table.stub'        => base_path() . $vueComponentPath . str_plural($child) . "Table.vue",
            'stubs/module/vue/FilterBar.stub'          => base_path() . "{$vueComponentPath}FilterBar.vue",
            'stubs/module/vue/FieldDefs.stub'          => base_path() . "{$vueComponentPath}FieldDefs.js",
            'stubs/module/vue/DetailRow.stub'          => base_path() . "{$vueComponentPath}DetailRow.vue",
            'stubs/module/blade/FormCreate.stub'       => base_path() . "{$bladePath}form_create.blade.php",
            'stubs/module/blade/FormEdit.stub'         => base_path() . "{$bladePath}form_edit.blade.php",
        ];
    }

    /**
     * fill the stub placeholders with the given child
     * @param  string $child
     * @param  string $stub
     * @return void
     */
    public function fillPlaceholders($child, $parent, $stub)
    {
        return str_replace(
            [
                '{{modelName}}',
                '{{modelNamePlural}}',
                '{{modelNamePluralLowerCase}}',
                '{{modelNameSingularLowerCase}}',
                '{{modelNameSingularKebabCase}}',
                '{{parentModelName}}',
                '{{parentModelNamePluralLowerCase}}',
                '{{parentModelNameSingularLowerCase}}',
            ],
            [
                $child,
                str_plural($child),
                snake_case(str_plural($child)),
                snake_case($child),
                kebab_case($child),
                $parent,
                snake_case(str_plural($parent)),
                snake_case($parent),
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
     * @param  string $child
     * @return void
     */
    protected function makeMigration($child)
    {
        Artisan::call('make:migration', [
            'name'     => 'create_' . snake_case($child) . '_module',
            '--create' => snake_case(str_plural($child)),
        ]);
    }

    /**
     * add module route to the web route file
     *
     * @return void
     */
    protected function addRoute($child, $parent)
    {
        $route = $this->fillPlaceholders($child, $parent, 'stubs/module_items/php/Route.stub');

        $web = str_replace_first(
            '// {{dont_delete_this_comment}}',
            $route,
            $this->getRoutContent()
        );

        $this->files->put($this->getRoutPath(), $web);
    }

    /**
     * append to parent model
     *
     * @return void
     */
    protected function appendParentModel($child, $parent)
    {
        $appends_code = $this->fillPlaceholders($child, $parent, 'stubs/module_items/php/ParentModelAppend.stub');

        $new_model = str_replace_first(
            '// {{dont_delete_this_comment}}',
            $appends_code,
            $this->getParentModelContent($parent)
        );

        $this->files->put($this->getParentModelPath($parent), $new_model);
    }

    /**
     * add module route to the web route file
     *
     * @return void
     */
    protected function registerVueTable($child, $parent)
    {
        $vueTable = $this->fillPlaceholders($child, $parent, 'stubs/module/vue/RegisterVueTable.stub');

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
    protected function RegisterSeeders($child)
    {
        $databaseSeeder = str_replace(
            [
                '// {{dont_delete_this_comment_one}}',
                // '// {{dont_delete_this_comment_two}}',
                // '// {{dont_delete_this_comment_three}}',
                '// {{dont_delete_this_comment_four}}',
            ],
            [
                'use Data\\' . str_plural($child) . 'TableSeeder;' . "\n" . '// {{dont_delete_this_comment_one}}',
                // 'use Modules\\' . $child . 'ModuleTableSeeder;' . "\n" . '// {{dont_delete_this_comment_two}}',
                // '$this->call(' . $child . 'ModuleTableSeeder::class);' . "\n" . '        // {{dont_delete_this_comment_three}}',
                '$this->call(' . str_plural($child) . 'TableSeeder::class);' . "\n" . '        // {{dont_delete_this_comment_four}}',
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
     * get the parent model file content
     *
     * @return string
     */
    protected function getParentModelContent($parent)
    {
        return $this->files->get($this->getParentModelPath($parent));
    }

    /**
     * get the parent model file path
     *
     * @return string
     */
    protected function getParentModelPath($parent)
    {
        return base_path() . "/app/Models/General/{$parent}.php";
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
