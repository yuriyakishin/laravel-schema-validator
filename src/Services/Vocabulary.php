<?php

namespace Yu\SchemaValidator\Services;

/**
 * The Schema.org types and their parents, from resources/vocabulary/types.php.
 */
class Vocabulary
{
    /** @var array<string, list<string>> type => direct parent types */
    private array $parents;

    public function __construct()
    {
        $this->parents = require dirname(__DIR__, 2).'/resources/vocabulary/types.php';
    }

    public function exists(string $type): bool
    {
        return isset($this->parents[$type]);
    }

    /**
     * Whether the type is one of the given types or a subtype of one, e.g. Restaurant is a LocalBusiness.
     *
     * @param  list<string>  $ancestors
     */
    public function isA(string $type, array $ancestors): bool
    {
        $queue = [$type];
        $seen = [];

        while ($queue !== []) {
            $current = array_shift($queue);

            if (in_array($current, $ancestors, true)) {
                return true;
            }

            if (!isset($seen[$current])) {
                $seen[$current] = true;
                array_push($queue, ...($this->parents[$current] ?? []));
            }
        }

        return false;
    }

    /**
     * The known type closest in spelling, for a hint like "Organisation → Organization".
     */
    public function suggest(string $type): ?string
    {
        $best = null;
        $distance = 4;

        foreach (array_keys($this->parents) as $known) {
            $current = levenshtein(strtolower($type), strtolower($known));

            if ($current < $distance) {
                [$best, $distance] = [$known, $current];
            }
        }

        return $best;
    }
}
