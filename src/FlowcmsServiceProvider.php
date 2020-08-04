<?php

namespace Flowcms\Flowcms;

use Illuminate\Routing\Router;
use Flowcms\Flowcms\Models\Page;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Flowcms\Flowcms\Middleware\HtmlMinifier;

class FlowcmsServiceProvider extends ServiceProvider
{
    private const FLOWCOMPONENTS = [
        "alert",
        "badge",
        "button",
        "card",
        "checkbox",
        "close",
        "disqus",
        "dropdown-item",
        "dropdown",
        "form",
        "google-analytics",
        "link",
        "nav-item",
        "navbar-link",
        "pikaday",
        "quill-editor",
        "search-input",
        "section-centered",
        "select-input",
        "switch",
        "table.data",
        "table.head",
        "text-input",
        "textarea-input",
        "toastr",
        "uppy",
    ];
    /**
     * Bootstrap the application services.
     */
    public function boot(Router $router)
    {
        /*
        * Optional methods to load your package assets
         */
        $router->middlewareGroup('HtmlMinifier', [HtmlMinifier::class]);

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'flowcms');
        $this->loadBladeDirectives();
        $this->loadBladeComponents();
        $this->loadMigrationsFrom(realpath(__DIR__ . '/../migrations'));
        if (!$this->app->runningInConsole()) {
            View::share('pages', Page::getPagesForMenu());
        }
    }

    protected function loadBladeDirectives()
    {
        Blade::directive('svg', function ($argument) {
            return "<?php echo file_get_contents($argument); ?>";
        });

        Blade::directive('nl2br', function ($expression) {
            return sprintf('<?php echo nl2br(e(%s)); ?>', $expression);
        });
    }

    public function loadBladeComponents()
    {
        collect(self::FLOWCOMPONENTS)->each(function (string $component) {
            Blade::component("flowcms::components.$component", "flowcms-$component");
        });
    }

    /**
     * Load helpers.
     */
    protected function loadHelpers()
    {
        foreach (glob(__DIR__ . '/Helpers/*.php') as $filename) {
            require_once $filename;
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Register the main class to use with the facade
        $loader = AliasLoader::getInstance();
        $loader->alias('Flowcms', FlowcmsFacade::class);

        $this->app->singleton('flowcms', function () {
            return new Flowcms();
        });

        $this->loadHelpers();
        $this->registerConfigs();

        if ($this->app->runningInConsole()) {
            $this->registerPublishableResources();
            $this->registerConsoleCommands();
        }

        $this->app->singleton('League\Glide\Server', function ($app) {
            // $filesystem = $app->make('Illuminate\Contracts\Filesystem\Filesystem');
            return \League\Glide\ServerFactory::create([
                'source' => storage_path('app/public'),
                'cache' => storage_path('app/public'),
                // 'source_path_prefix' => public_path('uploads'),
                'cache_path_prefix' => '.cache',
                'base_url' => 'img',
            ]);
        });
    }

    public function registerConfigs()
    {
        $this->mergeConfigFrom(
            dirname(__DIR__) . '/publishable/config/cms.php',
            'cms'
        );
        $this->mergeConfigFrom(
            dirname(__DIR__) . '/publishable/config/cms_settings.php',
            'cms_settings'
        );
        $this->mergeConfigFrom(
            dirname(__DIR__) . '/publishable/config/eloquent-viewable.php',
            'eloquent-viewable'
        );
    }

    /**
     * Register the publishable files.
     */
    private function registerPublishableResources()
    {
        $publishablePath = dirname(__DIR__) . '/publishable';

        $publishable = [
            'assets' => [
                "{$publishablePath}/assets/" => public_path(''),
            ],
            'seeds' => [
                "{$publishablePath}/database/seeds/" => database_path('seeds'),
            ],
            'config' => [
                "{$publishablePath}/config/cms.php" => config_path('cms.php'),
                "{$publishablePath}/config/cms_settings.php" => config_path('cms_settings.php'),
                "{$publishablePath}/config/eloquent-viewable.php" => config_path('eloquent-viewable.php'),
            ],

        ];

        foreach ($publishable as $group => $paths) {
            $this->publishes($paths, $group);
        }
    }

    /**
     * Register the commands accessible from the Console.
     */
    private function registerConsoleCommands()
    {
        $this->commands(Commands\InstallCommand::class);
    }
}
