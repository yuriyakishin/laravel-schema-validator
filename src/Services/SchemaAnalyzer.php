<?php

declare(strict_types=1);

namespace Yu\SchemaValidator\Services;

use Yu\SchemaValidator\Checks;
use Yu\SchemaValidator\Data\Item;
use Yu\SchemaValidator\Data\Snapshot;
use Yu\WebToolsCore\Checklist\ChecklistReport;
use Yu\WebToolsCore\Exceptions\ToolException;
use Yu\WebToolsCore\Http\SafeFetcher;

/**
 * Downloads the page, reads its JSON-LD and microdata and runs the checks.
 */
class SchemaAnalyzer
{
    /**
     * Checks by group, in the order of the report: S — syntax, R — Google rich results.
     * The letter codes are internal keys of the translations, the report never shows them.
     */
    public const array GROUPS = [
        'S' => [Checks\SyntaxCheck::class, Checks\ContextCheck::class, Checks\TypesCheck::class, Checks\FormatsCheck::class],
        'R' => [Checks\OrganizationCheck::class, Checks\WebSiteCheck::class, Checks\BreadcrumbCheck::class, Checks\ProductCheck::class, Checks\ReviewCheck::class, Checks\ArticleCheck::class, Checks\FaqCheck::class, Checks\EventCheck::class],
    ];

    /** Schema.org names of the rich results, shown as they are in every language. */
    public const array RICH_RESULTS = [
        'R1' => 'Organization', 'R2' => 'WebSite', 'R3' => 'BreadcrumbList', 'R4' => 'Product',
        'R5' => 'Review', 'R6' => 'Article', 'R7' => 'FAQPage', 'R8' => 'Event',
    ];

    /** Top-level items shown in the tree; a page with more is a catalogue and the rest add nothing. */
    private const int SHOWN_ITEMS = 30;

    public function __construct(private SafeFetcher $fetcher, private StructuredDataParser $parser) {}

    /**
     * The checklist report with the item tree under the key "items".
     *
     * @return array<string, mixed>
     *
     * @throws ToolException when the page cannot be read
     */
    public function analyze(string $url, string $locale): array
    {
        $page = $this->fetcher->fetch($url, ['text/html', 'application/xhtml'], (int) config('schema-validator.fetch.page_bytes'), 'text/html,application/xhtml+xml');

        if ($page->status !== 200) {
            throw new ToolException('http_error', ['status' => $page->status]);
        }

        $site = $this->parser->parse($page->body, $page->url, $page->charset);

        return [
            ...$this->report($site, $locale)->toArray(),
            'items' => array_map(fn (Item $item): array => $item->toArray(), array_slice($site->items, 0, self::SHOWN_ITEMS)),
        ];
    }

    public function report(Snapshot $site, string $locale): ChecklistReport
    {
        $groups = [];
        foreach (self::GROUPS as $group => $checks) {
            $groups[$group] = array_map(fn (string $check) => app($check)->run($site), $checks);
        }

        return new ChecklistReport(
            url: $site->url,
            locale: $locale,
            checkedAt: now()->toIso8601String(),
            ruleset: (string) config('schema-validator.ruleset'),
            groups: $groups,
        );
    }
}
