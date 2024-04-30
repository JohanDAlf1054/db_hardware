@auth
@if ($table === 'supplier')
    <div class="bread_crumb">
        {{ Breadcrumbs::render('supplier.edit', $person) }}
    </div>
@elseif ($table === 'customer')
    <div class="bread_crumb">
        {{ Breadcrumbs::render('customer.edit', $person) }}
    </div>
@endif
    <form method="POST" action="{{ route('person.update', $person->id) }}"  role="form" enctype="multipart/form-data">
        {{ method_field('PATCH') }}
        @csrf

        @include('person.form')

    </form>

@endauth
@guest
    @include('include.falta_sesion')
@endguest
