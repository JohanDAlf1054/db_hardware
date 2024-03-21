@auth
@include('include.barra', ['modo'=>''])

    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

             
                    </div>
                    
                        <form method="POST" action="{{ route('detail-purchases.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('detail-purchase.form')

                        </form>
                 
               
            </div>
        </div>
    </section>


@endauth
