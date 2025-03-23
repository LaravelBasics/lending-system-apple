@if(session('flashMessage'))
<div class="alert alert-{{ session('flashStatus') }}">
    {{ session('flashMessage') }}
</div>
@endif