@php($t = fn (string $key, array $replace = []) => __('schema-validator::messages.'.$key, $replace, $locale))

<div class="wt" lang="{{ $locale }}" x-data="{
        step: 0,
        timer: null,
        start() { this.step = 0; clearInterval(this.timer); this.timer = setInterval(() => this.step = Math.min(this.step + 1, 2), 1200) },
        again() { this.$refs.form.scrollIntoView({ behavior: 'smooth', block: 'center' }); this.$refs.url.focus({ preventScroll: true }); this.$refs.url.select() },
    }" @wt-again="again()">
    <form class="wt-tool" wire:submit="analyze" @submit="start()" x-ref="form" novalidate>
        <div class="wt-row">
            <div @class(['wt-field', 'wt-field-err' => $errors->has('url')])>
                <input id="wt-url" type="text" inputmode="url" autocomplete="url" placeholder=" "
                       wire:model="url" x-ref="url">
                <label for="wt-url">{{ $t('form.label') }}</label>
            </div>
            <button type="submit" class="wt-go" wire:loading.attr="disabled" wire:target="analyze">
                <span wire:loading.remove wire:target="analyze">{{ $t('form.button') }}</span>
                <span wire:loading wire:target="analyze" class="wt-spin" aria-hidden="true"></span>
            </button>
        </div>
        <p class="wt-hint">{{ $t('form.hint', ['count' => config('schema-validator.rate_limit.per_hour')]) }}</p>
        @error('url')<p class="wt-error">{{ $message }}</p>@enderror
        @if ($error)
            <p class="wt-error" role="alert">{{ $error }}</p>
        @endif
    </form>

    {{-- Lines light up on a timer while one request runs; the server does not report its steps --}}
    <div class="wt-log" wire:loading.block wire:target="analyze" aria-hidden="true">
        @foreach (['page', 'markup', 'checks'] as $i => $line)
            <p :class="{ 'wt-run': step === {{ $i }}, 'wt-done': step > {{ $i }} }">{{ $t('loading.'.$line) }}</p>
        @endforeach
    </div>

    @if ($report)
        {{-- A new block for every check (keyed by the count), so each report scrolls the tool up to its form --}}
        <div wire:key="wt-report-{{ $reportNumber }}" wire:loading.remove wire:target="analyze" aria-live="polite"
             x-init="$root.scrollIntoView({ behavior: 'smooth', block: 'start' })">
            {{-- One badge per rich result the page has markup for: the R checks that were not skipped --}}
            @php($rich = array_values(array_filter(collect($report['groups'])->firstWhere('code', 'R')['checks'] ?? [], fn (array $check): bool => $check['status'] !== 'skip')))
            <section class="sv-rich" aria-labelledby="sv-rich-title">
                <h3 id="sv-rich-title">{{ $t('rich.title') }}</h3>
                @if ($rich)
                    <ul class="sv-badges">
                        @foreach ($rich as $check)
                            <li class="sv-badge wt-{{ $check['status'] }}"><b>{{ \Yu\SchemaValidator\Services\SchemaAnalyzer::RICH_RESULTS[$check['code']] }}</b><span>{{ $t('rich.'.$check['status']) }}</span></li>
                        @endforeach
                    </ul>
                @else
                    <p class="sv-none">{{ $t('rich.none') }}</p>
                @endif

                @if ($report['items'])
                    <details class="sv-tree">
                        <summary>{{ $t('tree.title', ['count' => count($report['items'])]) }}</summary>
                        <ul>
                            @foreach ($report['items'] as $item)
                                @include('schema-validator::partials.item', ['item' => $item])
                            @endforeach
                        </ul>
                    </details>
                @endif
            </section>

            @include('web-tools-core::checklist-report', ['report' => $report, 'tool' => 'schema-validator', 'locale' => $locale])
        </div>
    @endif
</div>
