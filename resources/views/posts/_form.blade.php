@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('posts.save') }}" method="POST">
    @csrf

    {{-- Hidden id present only when editing --}}
    <input type="hidden" name="id" value="{{ $post->id ?? '' }}">

    <div class="mb-3">
        <label class="form-label">Title</label>
        <input type="text" name="title" maxlength="50"
               class="form-control @error('title') is-invalid @enderror"
               value="{{ old('title', $post->title ?? '') }}">
        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Content</label>
        <textarea name="content" rows="6"
                  class="form-control @error('content') is-invalid @enderror">{{ old('content', $post->content ?? '') }}</textarea>
        @error('content')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Category</label>
        <select name="category_id" class="form-select @error('category_id') is-invalid @enderror">
            <option value="">-- Select a category --</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}"
                    {{ (string) old('category_id', $post->category_id ?? '') === (string) $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Status</label>
        <select name="is_active" class="form-select">
            @foreach (['Yes', 'No'] as $option)
                <option value="{{ $option }}"
                    {{ old('is_active', $post->is_active ?? 'Yes') === $option ? 'selected' : '' }}>
                    {{ $option }}
                </option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Save</button>
    <a href="{{ route('posts.index') }}" class="btn btn-secondary">Cancel</a>
</form>

