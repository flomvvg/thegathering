@include('base.base')
@include('base.nav')

<div class="container content-center">
    <h1>Select Profile Type</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Organizer</h5>
            <p>Organizers mostly create parties. They book artists and venues to create an event.</p>
            <a href="/organizers/create"><button class="btn btn-primary">Create Organizer Profile</button></a>
        </div>
    </div>
    <br>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Artist</h5>
            <p>Artists pay their music at events.</p>
            <a href="/artists/create"><button class="btn btn-primary">Create Artist Profile</button></a>
        </div>
    </div>
</div>
