@include('base.base')
@include('base.nav')
<div class="container">
    <h1>Create Artist Profile</h1>
    <form action="/artists" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name</label><span class="text-danger"> *</span>
            <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" name="description" id="description" cols="30" rows="10">{{ old('description') }}</textarea>
        </div>
        <div class="form-group">
            <label for="spotify">Spotify</label>
            <input class="form-control" type="text" name="spotify" id="spotify" value="{{ old('spotify') }}">
        </div>
        <div class="form-group">
            <label for="soundcloud">Soundcloud</label>
            <input class="form-control" type="text" name="soundcloud" id="soundcloud" value="{{ old('soundcloud') }}">
        </div>
        <div class="form-group">
            <label for="youtube">YouTube</label>
            <input class="form-control" type="text" name="youtube" id="youtube" value="{{ old('youtube') }}">
        </div>
        <div class="form-group">
            <label for="amazon_music">Amazon Music</label>
            <input class="form-control" type="text" name="amazon_music" id="amazon_music" value="{{ old('amazon_music') }}">
        </div>
        <div class="form-group">
            <label for="apple_music">Apple Music</label>
            <input class="form-control" type="text" name="apple_music" id="apple_music" value="{{ old('apple_music') }}">
        </div>
        <div class="form-group">
            <label for="website">Website</label>
            <input class="form-control" type="text" name="website" id="website" value="{{ old('website') }}">
        </div>
        <input type="hidden" name="tag" id="tag" value="s">
        <input type="submit" class="btn btn-primary" value="Submit" />
    </form>
</div>
