@php
    $role = $role ?? 'mahasiswa'; // default mahasiswa jika belum ada
    if ($role === 'admin') {
        $dashboardUrl = url('/admin/dashboard');
    } elseif ($role === 'dosen') {
        $dashboardUrl = url('/dosen/dashboard');
    } else {
        $dashboardUrl = url('/dashboard');
    }
@endphp

<nav class="flex text-sm text-[#7C8DB5] mb-4 pl-10" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-3">
        <li class="inline-flex items-center">
            <a href="{{ $dashboardUrl }}" class="inline-flex items-center gap-1 text-[#7C8DB5] hover:text-[#1E6AAE]">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3" />
                </svg>
                Home
            </a>
        </li>
        @isset($breadcrumbs)
            @foreach ($breadcrumbs as $breadcrumb)
                <li>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-2 text-[#7C8DB5]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                        @if (!$loop->last)
                            <a href="{{ $breadcrumb['url'] }}" class="text-[#7C8DB5] hover:text-[#1E6AAE]">
                                {{ $breadcrumb['label'] }}
                            </a>
                        @else
                            <span class="text-[#1E6AAE] font-semibold">{{ $breadcrumb['label'] }}</span>
                        @endif
                    </div>
                </li>
            @endforeach
        @endisset
    </ol>
</nav>