@section('title', 'LibraryAI')
<form action="{{ isset($article) ? route('articles.update', $article) : route('articles.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if(isset($article))
        @method('PUT')
    @endif

    <div class="form-group">
        <label for="title">Заголовок</label>
        <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $article->title ?? '') }}" required>
    </div>

    <div class="form-group">
        <label for="description">Описание</label>
        <textarea name="description" id="description" class="form-control">{{ old('description', $article->description ?? '') }}</textarea>
    </div>

    <div class="form-group">
        <label for="text">Текст статьи</label>
        <textarea name="text" id="text" class="form-control" required>{{ old('text', $article->text ?? '') }}</textarea>
    </div>

    <div class="form-group">
        <label for="preview">Превью</label>
        <input type="file" name="preview" id="preview" class="form-control-file">
        @if(isset($article) && $article->preview)
            <img src="{{ asset('storage/' . $article->preview) }}" alt="Превью" style="max-width: 200px; margin-top: 10px;">
        @endif
    </div>

    <div class="form-group">
        <label for="article_category_id">Категория</label>
        <select name="article_category_id" id="article_category_id" class="form-control" required>
            <option value="">Выберите категорию</option>
            @foreach ($articleCategories as $category)
                <option value="{{ $category->id }}" {{ isset($article) && $article->article_category_id == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary">{{ isset($article) ? 'Обновить' : 'Создать' }}</button>
</form>
