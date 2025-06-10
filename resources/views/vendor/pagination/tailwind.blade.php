@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-between">
        <div class="flex justify-between flex-1 sm:hidden">
            @if ($paginator->onFirstPage())
                <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md dark:text-gray-600 dark:bg-gray-800 dark:border-gray-600">
                    {!! __('pagination.previous') !!}
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:border-blue-700 dark:active:bg-gray-700 dark:active:text-gray-300">
                    {!! __('pagination.previous') !!}
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:border-blue-700 dark:active:bg-gray-700 dark:active:text-gray-300">
                    {!! __('pagination.next') !!}
                </a>
            @else
                <span class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md dark:text-gray-600 dark:bg-gray-800 dark:border-gray-600">
                    {!! __('pagination.next') !!}
                </span>
            @endif
        </div>

        {{-- <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between space-x-3">
            <div>
                <p class="text-sm text-gray-700 leading-5 dark:text-gray-400">
                    {!! __('Menampilkan') !!}
                    @if ($paginator->firstItem())
                        <span class="font-medium">{{ $paginator->firstItem() }}</span>
                        {!! __('hingga') !!}
                        <span class="font-medium">{{ $paginator->lastItem() }}</span>
                    @else
                        {{ $paginator->count() }}
                    @endif
                    {!! __('dari') !!}
                    <span class="font-medium">{{ $paginator->total() }}</span>
                    {!! __('hasil') !!}
                </p>
            </div> --}}

            <div>
                <span class="relative z-0 inline-flex rtl:flex-row-reverse rounded-md">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                            <span class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-[#1E6AAE] cursor-default rounded-l-md leading-5" aria-hidden="true">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-[#1E6AAE] bg-white border border-[#1E6AAE] rounded-l-md leading-5 hover:bg-[#1E6AAE] hover:text-white focus:z-10 focus:outline-none focus:ring ring-[#1E6AAE] focus:border-[#1E6AAE] active:bg-[#17497C] active:text-white transition ease-in-out duration-150" aria-label="{{ __('pagination.previous') }}">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    @endif

                    {{-- Pagination Elements --}}
                    @php
                        $current = $paginator->currentPage();
                        $last = $paginator->lastPage();
                        $start = max(1, $current - 3);
                        $end = min($last, $current + 3);
                        
                        if ($end - $start < 6) {
                            if ($start == 1) {
                                $end = min($last, 3);
                            } else {
                                $start = max(1, $last - 6);
                            }
                        }
                    @endphp

                    {{-- First page --}}
                    @if ($start > 1)
                        <a href="{{ $paginator->url(1) }}" class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-[#1E6AAE] bg-white border border-[#1E6AAE] leading-5 hover:bg-[#1E6AAE] hover:text-white focus:z-10 focus:outline-none focus:ring ring-[#1E6AAE] focus:border-[#1E6AAE] active:bg-[#17497C] active:text-white transition ease-in-out duration-150">
                            1
                        </a>
                        @if ($start > 2)
                            <span aria-disabled="true">
                                <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-[#1E6AAE] bg-white border border-[#1E6AAE] cursor-default leading-5">...</span>
                            </span>
                        @endif
                    @endif

                    {{-- Page numbers --}}
                    @for ($page = $start; $page <= $end; $page++)
                        @if ($page == $current)
                            <span aria-current="page">
                                <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-white bg-[#1E6AAE] border border-[#1E6AAE] cursor-default leading-5">{{ $page }}</span>
                            </span>
                        @else
                            <a href="{{ $paginator->url($page) }}" class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-[#1E6AAE] bg-white border border-[#1E6AAE] leading-5 hover:bg-[#1E6AAE] hover:text-white focus:z-10 focus:outline-none focus:ring ring-[#1E6AAE] focus:border-[#1E6AAE] active:bg-[#17497C] active:text-white transition ease-in-out duration-150">
                                {{ $page }}
                            </a>
                        @endif
                    @endfor

                    {{-- Last page --}}
                    @if ($end < $last)
                        @if ($end < $last - 1)
                            <span aria-disabled="true">
                                <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-[#1E6AAE] bg-white border border-[#1E6AAE] cursor-default leading-5">...</span>
                            </span>
                        @endif
                        <a href="{{ $paginator->url($last) }}" class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-[#1E6AAE] bg-white border border-[#1E6AAE] leading-5 hover:bg-[#1E6AAE] hover:text-white focus:z-10 focus:outline-none focus:ring ring-[#1E6AAE] focus:border-[#1E6AAE] active:bg-[#17497C] active:text-white transition ease-in-out duration-150">
                            {{ $last }}
                        </a>
                    @endif

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-[#1E6AAE] bg-white border border-[#1E6AAE] rounded-r-md leading-5 hover:bg-[#1E6AAE] hover:text-white focus:z-10 focus:outline-none focus:ring ring-[#1E6AAE] focus:border-[#1E6AAE] active:bg-[#17497C] active:text-white transition ease-in-out duration-150" aria-label="{{ __('pagination.next') }}">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    @else
                        <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                            <span class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-[#1E6AAE] cursor-default rounded-r-md leading-5" aria-hidden="true">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </span>
                    @endif
                </span>
            </div>
        </div>
    </nav>
@endif
