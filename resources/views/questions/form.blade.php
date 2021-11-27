@csrf
<div class="md-form mt-2">
  <label>タイトル</label>
  <input type="text" name="title" class="form-control" required value="{{ $question->title ?? old('title') }}">
</div>
<div class="form-group mt-3">
  <label>本文</label>
  <textarea name="body" required class="form-control" rows="10" placeholder="5文字以上入力してください">{{ $question->body ?? old('body') }}</textarea>
</div>
