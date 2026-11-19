<?php

declare(strict_types=1);

namespace Yu\SchemaValidator\Checks;

use Yu\SchemaValidator\Data\Snapshot;
use Yu\WebToolsCore\Checklist\Check;

/**
 * One rule of the report. Its title, description and advice are translations under messages.checks.{code}.
 */
interface SchemaCheck
{
    public function run(Snapshot $site): Check;
}
