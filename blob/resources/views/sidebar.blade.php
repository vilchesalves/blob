<div class="sidebar-module sidebar-module-inset">
    <h4>About</h4>
    <p>Etiam porta
        <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean
        lacinia bibendum nulla sed consectetur.</p>
</div>
<div class="sidebar-module">
    <h4>Archives</h4>
    <ol class="list-unstyled">
        @foreach ($months as $monthObj)
            <li>
                <a href="{{ route('post.archive', [
                    'month' => $monthObj->_id->month,
                    'year' => $monthObj->_id->year,
                ]) }}">
                    {{ $monthObj->_id->monthName }}
                    {{ $monthObj->_id->year }}
                </a>
            </li>
        @endforeach
    </ol>
</div>
<div class="sidebar-module">
    <h4>Elsewhere</h4>
    <ol class="list-unstyled">
        <li>
            <a href="#">GitHub</a>
        </li>
        <li>
            <a href="#">Twitter</a>
        </li>
        <li>
            <a href="#">Facebook</a>
        </li>
    </ol>
</div>
