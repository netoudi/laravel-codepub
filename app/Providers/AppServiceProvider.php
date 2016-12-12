<?php

namespace CodePub\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Form::macro('error', function ($field, $errors) {
            if (!str_contains($field, '.*') && $errors->has($field) || count($errors->get($field)) > 0) {
                return view('errors.error_field', compact('field'));
            }

            return null;
        });

        \Html::macro('openFormGroup', function ($field = null, $errors = null) {
            $result = false;

            if ($field != null && $errors != null) {
                if (is_array($field)) {
                    foreach ($field as $value) {
                        if (!str_contains($value, '.*') && $errors->has($value) || count($errors->get($value)) > 0) {
                            $result = true;
                            break;
                        }
                    }
                } elseif (!str_contains($field, '.*') && $errors->has($field) || count($errors->get($field)) > 0) {
                    $result = true;
                }
            }

            return sprintf("<div class=\"%s\">", ($result ? 'form-group has-error' : 'form-group'));
        });

        \Html::macro('closeFormGroup', function () {
            return "</div>";
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }

        require_once __DIR__ . '/../Http/Helpers/Navigation.php';
    }
}
