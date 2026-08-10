@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('categories.save') }}" method="POST">
    @csrf

    <input type="hidden" name="id" value="{{ $category->id ?? '' }}">

    <div class="mb-3">
        <label class="form-label">Name</label>
        <input type="text" name="name" maxlength="50"
               class="form-control @error('name') is-invalid @enderror"
               value="{{ old('name', $category->name ?? '') }}">
        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Content</label>
        <textarea name="content" rows="4"
                  class="form-control @error('content') is-invalid @enderror">{{ old('content', $category->content ?? '') }}</textarea>
        @error('content')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <button type="submit" class="btn btn-primary">Save</button>
    <a href="{{ route('categories.index') }}" class="btn btn-secondary">Cancel</a>
</form>