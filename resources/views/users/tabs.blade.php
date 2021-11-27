<ul class="nav nav-pills nav-justified my-2">
    <li class=" nav-item bg-white mx-1" style="border-radius: 12px">
        <a href="" class="nav-link px-1 pt-1 pb-0 btn btn-sm {{ $hasQuestion ? 'active text-white btn-outline-success' : 'btn-outline-teal1' }}" style="border-radius: 12px">
            <p>質問</p>
        </a>
    </li>
    <li class="nav-item bg-white mx-1" style="border-radius: 12px">
        <a href="" class="nav-link px-1 pt-1 pb-0 btn btn-sm {{ $hasAnswer ? 'active text-white btn-outline-success' : 'btn-outline-teal1' }}" style="border-radius: 12px">
            <p>回答</p>
        </a>
    </li>
    <li class=" nav-item bg-white mx-1" style="border-radius: 12px">
        <a href="" class="nav-link px-1 pt-1 pb-0 btn btn-sm {{ $hasGood ? 'active text-white btn-outline-danger' : 'btn-outline-teal1' }}" style="border-radius: 12px">
            <p>いいね</p>
        </a>
    </li>
</ul>
