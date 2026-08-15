<article class="worker-card">
    <div class="worker-card-head">
        <div class="avatar" style="--avatar: {{ $worker->avatar_color ?: '#1d4ed8' }}">{{ $worker->initials }}</div>
        <div class="worker-main"><h3>{{ $worker->name }}</h3><p>{{ $worker->category_label }}</p></div>@if($worker->is_verified)<span class="verified-badge">✓ Verified</span>@endif
        <span class="status-dot {{ $worker->availability_status }}">{{ $worker->availability_label }}</span>
    </div>
    <div class="worker-rating">★ {{ $worker->rating > 0 ? number_format((float) $worker->rating, 1) : 'New' }} <span>{{ $worker->ratings_count ? '('.$worker->ratings_count.')' : '' }}</span></div>
    <div class="worker-meta">
        <span>⌖ {{ $worker->area ? $worker->area.', ' : '' }}{{ $worker->city }}</span>
        <span>◷ {{ $worker->experience_years }} {{ $worker->experience_years == 1 ? 'year' : 'years' }}</span>
    </div>
    @if($worker->skills)
        <div class="tags">@foreach(array_slice($worker->skills, 0, 3) as $skill)<span>{{ $skill }}</span>@endforeach</div>
    @endif
    <div class="worker-footer">
        <div>@if($worker->hourly_rate)<strong>₹{{ number_format((float)$worker->hourly_rate) }}</strong><small>/ hour approx.</small>@else<strong>Rate on request</strong>@endif</div>
        <a href="{{ route('workers.show', $worker) }}" class="btn btn-small">View profile</a>
    </div>
</article>
