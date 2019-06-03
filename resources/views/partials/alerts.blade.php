<div class="container mt-3">
    <div class="alert alert-{{session('alert-type')??'info'}} alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <span>{!! session('message') !!}</span>
    </div>
</div>

