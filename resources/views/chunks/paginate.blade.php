<?php
/** @var \Illuminate\Pagination\LengthAwarePaginator $paginator */
//var_dump($paginator);die;
?>
@if($paginator->lastPage() >1 )
    <section class="nav-bar" style="padding-top: 10px" >
        <nav>
            <ul>
                <li class="{{ ($paginator->currentPage() == 1) ? ' disabled' : '' }}">
                    <a href="{{ $paginator->url(1) }}">&lt;</a>
                </li>
                @if($paginator->lastPage() > 5)
                    <?php $end = $paginator->lastPage(); ?>
                    <?php $start = $paginator->lastPage() - 5; ?>
                @else
                    <?php $end = $paginator->lastPage(); ?>
                    <?php $start = 1; ?>
                @endif
                @for ($i = $start; $i <= $end; $i++)
                    <li class="{{ ($paginator->currentPage() == $i) ? ' selected' : '' }}">
                        <a href="{{ $paginator->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor
                <li class="{{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}">
                    <a href="{{ $paginator->url($paginator->currentPage()+1) }}">&gt;</a>
                </li>
            </ul>
        </nav>
    </section>
@endif