@csrf
<div class="form-group mt-3 mx-auto" style="max-width: 50rem;">
    <div class="card">
        <div class="card-header">
            あなたの回答
        </div>
        <textarea name="body" required class="form-control" rows="7" placeholder="回答を入力してください">{{ $hasStore ? old('body') :$answer->body  }}</textarea>
    </div>
</div>
