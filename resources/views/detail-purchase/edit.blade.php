@auth
@include('include.barras', ['modo'=>''])
@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    
                    <div class="card-body">
                        <form method="POST" action="{{ route('detail-purchases.update', $detailPurchase->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('detail-purchase.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endauth
