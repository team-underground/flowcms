<?php

namespace Flowcms\Flowcms\Commands;

use Flowcms\Flowcms\FlowcmsServiceProvider;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Process\Process;
use Flowcms\Flowcms\Providers\VoyagerDummyServiceProvider;
use Flowcms\Flowcms\Traits\Seedable;
use Flowcms\Flowcms\VoyagerServiceProvider;

class InstallCommand extends Command
{
    use Seedable;

    protected $seedersPath = __DIR__ . '/../../publishable/database/seeds/';

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'flowcms:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the Flowcms Admin panel';

    protected function getOptions()
    {
        return [
            ['force', null, InputOption::VALUE_NONE, 'Force the operation to run when in production', null],
            // ['with-dummy', null, InputOption::VALUE_NONE, 'Install with dummy data', null],
        ];
    }

    /**
     * Get the composer command for the environment.
     *
     * @return string
     */
    protected function findComposer()
    {
        if (file_exists(getcwd() . '/composer.phar')) {
            return '"' . PHP_BINARY . '" ' . getcwd() . '/composer.phar';
        }

        return 'composer';
    }

    public function fire(Filesystem $filesystem)
    {
        return $this->handle($filesystem);
    }

    /**
     * Execute the console command.
     *
     * @param \Illuminate\Filesystem\Filesystem $filesystem
     *
     * @return void
     */
    public function handle(Filesystem $filesystem)
    {
        $this->info('Publishing the Flowcms assets, database, and config files');

        // Publish only relevant resources on install
        $tags = ['seeds'];

        $this->call('vendor:publish', ['--provider' => FlowcmsServiceProvider::class, '--tag' => $tags]);

        $this->info('Migrating the database tables into your application');
        $this->call('migrate', ['--force' => $this->option('force')]);

        $this->info('Attempting to set Flowcms User model as parent to App\User');
        if (file_exists(app_path('User.php'))) {
            $str = file_get_contents(app_path('User.php'));

            if ($str !== false) {
                $str = str_replace('extends Authenticatable', "extends \Flowcms\Flowcms\Models\User", $str);

                file_put_contents(app_path('User.php'), $str);
            }
        } else {
            $this->warn('Unable to locate "app/User.php".  Did you move this file?');
            $this->warn('You will need to update this manually.  Change "extends Authenticatable" to "extends \Flowcms\Flowcms\Models\User" in your User model');
        }

        $this->info('Dumping the autoloaded files and reloading all new files');

        $composer = $this->findComposer();

        $process = new Process([$composer . ' dump-autoload']);
        $process->setTimeout(null); // Setting timeout to null to prevent installation from stopping at a certain point in time
        $process->setWorkingDirectory(base_path())->run();

        $this->info('Adding Flowcms routes to routes/web.php');
        $routes_contents = $filesystem->get(base_path('routes/web.php'));
        if (false === strpos($routes_contents, 'Flowcms::routes()')) {
            $filesystem->append(
                base_path('routes/web.php'),
                "\nFlowcms::routes();\n"
            );
        }

        $this->info('Seeding data into the database');
        $this->seed('FlowcmsDatabaseSeeder');

        $this->call('vendor:publish', ['--provider' => FlowcmsServiceProvider::class, '--tag' => ['assets', 'config']]);

        $this->info('Adding the storage symlink to your public folder');
        $this->call('storage:link');

        $this->info('Successfully installed Flowcms! Enjoy');
    }
}
