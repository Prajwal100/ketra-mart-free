<style>
    .list-group-item li, a {
        color: #686868;
        font-weight: 600;
    }

    .list-group-item li, a:hover {
        color: #686868;
        font-weight: 600;

    }
</style>
<ul class="list-group list-group-flush">
    @foreach($products as $i)
        <li class="list-group-item" onclick="$('.search-form').submit()">
            <a href="javascript:" onmouseover="$('.search-bar-input-mobile').val('{{ucfirst($i['title'])}}');$('.search-bar-input').val('{{ucfirst($i['title'])}}');">
                {{ucfirst($i['title'])}}
            </a>
        </li>
    @endforeach
</ul>
