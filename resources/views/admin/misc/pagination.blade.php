<nav aria-label="Page navigation example">
	@if ($paginator->lastPage() > 1)
	<ul class="pagination justify-content-center">
		<li class="page-item {{ ($paginator->currentPage() == 1) ? ' disabled' : '' }}">
			<a class="page-link" href="#" tabindex="-1" href="{{ $paginator->url(1) }}">Previous</a>
		</li>

		@for ($i = 1; $i <= $paginator->lastPage(); $i++)
		<li class="page-item {{ ($paginator->currentPage() == $i) ? ' active' : '' }}">
			<a class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a>
		</li>
		@endfor
		<li class="page-item {{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}">
			<a class="page-link" href="{{ $paginator->url($paginator->currentPage()+1) }}">Next</a>
		</li>
	</ul>
	@endif
</nav>