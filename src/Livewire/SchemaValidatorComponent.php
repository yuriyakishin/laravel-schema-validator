<?php

declare(strict_types=1);

namespace Yu\SchemaValidator\Livewire;

use Illuminate\Contracts\View\View;
use Yu\SchemaValidator\Events\SchemaValidatorEvent;
use Yu\SchemaValidator\Services\SchemaAnalyzer;
use Yu\WebToolsCore\Livewire\ToolComponent;
use Yu\WebToolsCore\Locale\LocaleResolver;

/**
 * The structured data check: the form, the loading log, the rich results summary, the item tree and the checklist report.
 */
class SchemaValidatorComponent extends ToolComponent
{
    protected function name(): string
    {
        return 'schema-validator';
    }

    protected function event(): string
    {
        return SchemaValidatorEvent::class;
    }

    protected function locales(): LocaleResolver
    {
        return new LocaleResolver(dirname(__DIR__, 2).'/resources/lang');
    }

    protected function run(string $url, string $locale): array
    {
        return app(SchemaAnalyzer::class)->analyze($url, $locale);
    }

    public function render(): View
    {
        return view('schema-validator::schema-validator');
    }
}
