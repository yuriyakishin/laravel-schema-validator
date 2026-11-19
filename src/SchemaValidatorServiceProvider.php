<?php

declare(strict_types=1);

namespace Yu\SchemaValidator;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Yu\SchemaValidator\Livewire\SchemaValidatorComponent;
use Yu\SchemaValidator\Services\Vocabulary;

class SchemaValidatorServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/schema-validator.php', 'schema-validator');

        // The type list is 1500 entries: read it once per request
        $this->app->singleton(Vocabulary::class);
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'schema-validator');
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'schema-validator');

        // The name is required: without it Livewire 4 makes up a hash and <livewire:schema-validator /> is not found
        Livewire::component('schema-validator', SchemaValidatorComponent::class);
    }
}
