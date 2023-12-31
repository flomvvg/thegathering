@include('base.base')
@include('base.nav')
<div class="container">
    <h1>Create Organizer Profile</h1>
    <form action="/organizers" method="POST">
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
            <label for="website">Website</label>
            <input class="form-control" type="text" name="website" id="website" value="{{ old('website') }}">
        </div>
        <input type="hidden" name="tag" id="tag" value="s">
        <input type="submit" class="btn btn-primary" value="Submit" />
    </form>
</div>
