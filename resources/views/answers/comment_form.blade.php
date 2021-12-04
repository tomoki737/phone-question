@csrf
@include('error_card_list')
<div class="form-group mt-2 mx-auto" style="max-width: 50rem;">
        <textarea name="body" required class="form-control" rows="1" placeholder="コメントを入力してください">{{ old('body') }}</textarea>
</div>
