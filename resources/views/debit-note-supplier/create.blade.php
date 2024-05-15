@auth
@can('debit-note-supplier')


<div class="bread_crumb">
    {{ Breadcrumbs::render('debit.note.supplier.create') }}
</div>
    <form method="POST" action="{{ route('debit-note-supplier.store') }}"  role="form" enctype="multipart/form-data">
        @csrf

     @include('debit-note-supplier.form')
    </form>

@endcan
@endauth
@guest
    @include('include.falta_sesion')
@endguest
