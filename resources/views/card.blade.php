
<div class="border-bottom bg-white p-3">
        <div class="row mb-2">
            <div class="col-sm-10">
            <a href="{{ route('questions.show', ['question' => $question]) }}" class="text-decoration-none h5">{{$question->title}}</a>
            </div>
            @if(Auth::id() === $question->user_id)
            <div class="col-sm-2 text-right">
                <div class="dropdown d-flex flex-row-reverse">
                    <i class="fas fa-ellipsis-v btn" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false"></i>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item" href="{{ route('questions.edit', ['question' => $question]) }}">編集</a></li>
                        <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#confirmationMordal" href="#">削除</a></li>
                    </ul>

                    <!-- Modal -->
                    <div class="modal fade" id="confirmationMordal" tabindex="-1" aria-labelledby="confirmationMordalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="confirmationMordalLabel">Modal title</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{route('questions.destroy', ['question' => $question])}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-body">
                                        削除してもよろしいですか
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">キャンセル</button>
                                        <button type="submit" class="btn btn-primary">削除</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
            <div class="small col-sm-6 py-0">{{$question->created_at}}</div>
            <div class="small col-sm-6 text-end">{{$question->user->name}}</div>
    </div>
</div>

