{{-- One item of the tree with its properties; nested items repeat this partial --}}
<li class="sv-item">
    <span class="sv-type">{{ $item['types'] ? implode(', ', $item['types']) : '?' }}</span>
    <small class="sv-source">{{ $item['source'] }}</small>
    @if ($item['properties'])
        <dl>
            @foreach ($item['properties'] as $name => $values)
                <div>
                    <dt>{{ $name }}</dt>
                    <dd>
                        @foreach ($values as $value)
                            @if (is_array($value))
                                <ul>@include('schema-validator::partials.item', ['item' => $value])</ul>
                            @else
                                <code>{{ $value }}</code>
                            @endif
                        @endforeach
                    </dd>
                </div>
            @endforeach
        </dl>
    @endif
</li>
