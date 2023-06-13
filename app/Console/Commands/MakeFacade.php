<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class MakeFacade extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:make-facade {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make a new facade';

    public function __construct(public Filesystem $files)
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $facadeName = $this->argument('name');
        if (empty($facadeName)) {
            return $this->error('Facade Name required.');
        }

        $path = app_path();

        $facadeDirectory = $path . "/Facades/$facadeName";

        if ($this->files->isDirectory($facadeDirectory)) {
            return $this->error("$facadeDirectory already exists");
        }
        $this->files->makeDirectory($facadeDirectory, 0777, true, true);
        // Make Facade File
        $facadeFileName = $facadeName . 'Facade';
        $file = "$facadeFileName.php";
        $file = $path . "/Facades/$facadeName/$file";
        $facadeContent = $this->facadeContent();
        // if no file or directory exists,
        if ($this->files->isFile($file)) {
            return $this->error("$file already exists");
        }
        if (!$this->files->put($file, $facadeContent)) {
            return $this->error('Something went wrong.');
        }
        $this->info("$facadeFileName created.");

        // Make Service File
        $facadeFileName = $facadeName . 'Service';
        $file = "$facadeFileName.php";
        $file = $path . "/Facades/$facadeName/$file";
        $serviceContent = $this->serviceContent();
        // if no file or directory exists,
        if ($this->files->isFile($file)) {
            return $this->error("$file already exists");
        }
        if (!$this->files->put($file, $serviceContent)) {
            return $this->error('Something went wrong.');
        }
        $this->info("$facadeFileName created.");

        // Make Service File
        $facadeFileName = $facadeName . 'FacadeServiceProvider';
        $file = "$facadeFileName.php";
        $file = $path . "/Providers/Facades/$file";
        $serviceProvideContent = $this->serviceProviderContent();
        // if no file or directory exists,
        if ($this->files->isFile($file)) {
            return $this->error("$file already exists");
        }
        if (!$this->files->put($file, $serviceProvideContent)) {
            return $this->error('Something went wrong.');
        }
        $this->info("$facadeFileName created.");
    }


    private function facadeContent(): string
    {
        $facadeName = $this->argument('name');
        // separate words with camel case
        $facadeAccessor = $this->facadeAccessor();
        return "<?php
namespace App\Facades\\" . $facadeName . ";

use Illuminate\Support\Facades\Facade;

/**
 *
 */
class " . $facadeName . "Facade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return '" . $facadeAccessor . "_facade';
    }
}
";
    }

    private function serviceContent(): string
    {
        $facadeName = $this->argument('name');

        return "<?php

namespace App\Facades\\" . $facadeName . ";


class " . $facadeName . "Service
{

}
";
    }


    private function serviceProviderContent(): string
    {
        $facadeName = $this->argument('name');
        $facadeAccessor = $this->facadeAccessor();
        return '<?php

namespace App\Providers\Facades;

use App\Facades\\' . $facadeName . '\\' . $facadeName . 'Service;
use Illuminate\Support\ServiceProvider;

class ' . $facadeName . 'FacadeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton("' . $facadeAccessor . '_facade", function () {
            return new ' . $facadeName . 'Service();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

        ';
    }

    private function facadeAccessor(): string
    {
        $facadeName = $this->argument('name');
        $facadeAccessor = Str::of($facadeName)->split('/(?=[A-Z])/');
        // remove null items
        $facadeAccessor = $facadeAccessor->filter(fn($item) => !empty($item));
        // lowercase items
        $facadeAccessor = $facadeAccessor->map(fn($item) => Str::lower($item));
        // get values and set to array
        $facadeAccessor = $facadeAccessor->values()->toArray();
        // contact with '_'
        return implode('_', $facadeAccessor);
    }
}
