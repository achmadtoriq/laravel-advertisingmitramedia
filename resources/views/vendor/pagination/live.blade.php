@if ($paginator->hasPages())

    <nav class="flex justify-center gap-2">

        @if ($paginator->onFirstPage())
            <span class="px-4 py-2 bg-gray-200 rounded">Prev</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="pagination-link px-4 py-2 bg-gray-100 rounded">
                Prev
            </a>
        @endif


        @foreach ($elements as $element)
            @if (is_string($element))
                <span>{{ $element }}</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    <a href="{{ $url }}"
                        class="pagination-link px-4 py-2 rounded
{{ $page == $paginator->currentPage() ? 'bg-red-600 text-white' : 'bg-gray-100' }}">

                        {{ $page }}

                    </a>
                @endforeach
            @endif
        @endforeach


        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="pagination-link px-4 py-2 bg-gray-100 rounded">
                Next
            </a>
        @else
            <span class="px-4 py-2 bg-gray-200 rounded">Next</span>
        @endif

    </nav>

@endif


<script id="hkk63k">
    document.addEventListener("click", function(e) {

        if (e.target.classList.contains("pagination-link")) {

            e.preventDefault()

            fetch(e.target.href)
                .then(res => res.text())
                .then(html => {

                    let parser = new DOMParser()
                    let doc = parser.parseFromString(html, 'text/html')

                    let newArticles =
                        doc.querySelector("#article-container").innerHTML

                    document.querySelector("#article-container").innerHTML =
                        newArticles

                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    })

                })

        }

    })
</script>
