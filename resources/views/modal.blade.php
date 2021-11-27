<div class="col-sm-1">
    <div class="dropdown d-flex flex-row-reverse">
        <i class="fas fa-ellipsis-v btn" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false"></i>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            @if($questionModal)
            <li><a class="dropdown-item" href="{{ route('questions.edit', ['question' => $question]) }}">編集</a></li>
            @endif
            @if($answerModal)
            <li><a class="dropdown-item" href="{{ route('answers.edit', ['answer' => $answer]) }}">編集</a></li>
            @endif
            <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#confirmationMordal">削除</a></li>
        </ul>

        <!-- Modal -->
        <div class="modal fade" id="confirmationMordal" tabindex="-1" aria-labelledby="confirmationMordalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmationMordalLabel">削除の確認</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    @if($questionModal)
                    <form action="{{route('questions.destroy', ['question' => $question])}}" method="post">
                        @endif
                        @if($answerModal)
                        <form action="{{route('answers.destroy', ['answer' => $answer])}}" method="post">
                            @method('DELETE')
                            @endif
                            @csrf
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
