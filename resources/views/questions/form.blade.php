@csrf
@include('error_card_list')
<div class="md-form mt-2">
    <label>タイトル</label>
    <input type="text" name="title" class="form-control" placeholder="タイトルを入力してください" required value="{{ $question->title ?? old('title') }}">
</div>
<div class="form-group mt-3">
    <label>本文</label>
    <textarea name="body" required class="form-control" rows="10" placeholder="本文を入力してください">{{ $question->body ?? old('body') }}</textarea>
</div>
<div class="mt-3">
  <label for="formFile" class="form-label">画像を選択</label>
  <input class="form-control" type="file" name="image">
</div>
