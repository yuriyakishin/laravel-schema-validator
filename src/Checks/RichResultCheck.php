<?php

namespace Yu\SchemaValidator\Checks;

use Yu\SchemaValidator\Data\Item;
use Yu\SchemaValidator\Data\Snapshot;
use Yu\SchemaValidator\Services\Vocabulary;
use Yu\WebToolsCore\Checklist\Check;

/**
 * A Google rich result: the items of its types and the fields Google requires and recommends for them.
 * The check is skipped when the page has no item of these types, so it does not lower the score of other pages.
 * Missing fields are listed per item, e.g. "Product «Roses»: offers.priceCurrency".
 */
abstract class RichResultCheck implements SchemaCheck
{
    /** Points when every required field is there but some recommended ones are not. */
    private const int RECOMMENDED_POINTS = 7;

    public function __construct(protected Vocabulary $vocabulary) {}

    abstract protected function code(): string;

    /**
     * Schema.org types of the rich result; their subtypes count too.
     *
     * @return list<string>
     */
    abstract protected function types(): array;

    /**
     * The missing required and recommended fields of one item.
     *
     * @return array{0: list<string>, 1: list<string>}
     */
    abstract protected function missing(Item $item): array;

    /**
     * A JSON-LD example with every required and recommended field.
     */
    abstract protected function snippet(): string;

    /**
     * Whether nested items count too; off for types that are also used as parts of others, like a publisher Organization.
     */
    protected function includesNested(): bool
    {
        return true;
    }

    public function run(Snapshot $site): Check
    {
        $items = array_values(array_filter(
            $site->find($this->types(), $this->vocabulary),
            fn (Item $item): bool => $this->includesNested() || !$item->nested,
        ));

        if ($items === []) {
            return Check::skip($this->code(), 10, 'absent');
        }

        $required = [];
        $recommended = [];
        foreach ($items as $item) {
            [$requiredFields, $recommendedFields] = $this->missing($item);

            if ($requiredFields !== []) {
                $required[] = $item->label().': '.implode(', ', $requiredFields);
            }
            if ($recommendedFields !== []) {
                $recommended[] = $item->label().': '.implode(', ', $recommendedFields);
            }
        }

        $replace = ['count' => count($items)];

        return match (true) {
            $required !== [] => Check::fail($this->code(), 10, 'required', $replace, array_values(array_unique($required)), $this->snippet()),
            $recommended !== [] => Check::warn($this->code(), self::RECOMMENDED_POINTS, 10, 'recommended', $replace, array_values(array_unique($recommended)), $this->snippet()),
            default => Check::pass($this->code(), 10, 'ok', $replace, array_values(array_unique(array_map(fn (Item $item): string => $item->label(), $items)))),
        };
    }

    /**
     * The fields of the list the item does not have. A field is "name", "a|b" for either of two
     * or "a.b" for a field of a nested item; text in place of a nested item counts for "author.name".
     *
     * @param  list<string>  $fields
     * @return list<string>
     */
    protected function absent(Item $item, array $fields): array
    {
        return array_values(array_filter($fields, fn (string $field): bool => !$this->present($item, $field)));
    }

    protected function present(Item $item, string $field): bool
    {
        foreach (explode('|', $field) as $alternative) {
            $path = explode('.', $alternative, 2);

            if (count($path) === 1 && $item->has($alternative)) {
                return true;
            }

            if (count($path) === 2) {
                foreach ($item->values($path[0]) as $value) {
                    if ($value instanceof Item ? $this->present($value, $path[1]) : ($path[1] === 'name' && trim($value) !== '')) {
                        return true;
                    }
                }
            }
        }

        return false;
    }

    protected function isA(Item $item, string $type): bool
    {
        return array_any($item->types, fn (string $own): bool => $this->vocabulary->isA($own, [$type]));
    }
}
