@include('include.barra', ['modo'=>'Sub Categorias'])
<br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-10-sm">
                <div class="card">
                    <div class="card-header">
                        <div  style="display: flex; align-items: center; justify-content: space-between">
                            <button type="button" class="btn btn-light">
                                <a href="{{route('category.index')}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l14 0" /><path d="M5 12l6 6" /><path d="M5 12l6 -6" /></svg>
                                </a>
                            </button>
                            <h2 id="card_title">
                                {{ __('Todas Las Sub Categorias') }}
                            </h2>
                            <button type="button" class="btn btn-warning mx-2 rounded" data-bs-toggle="modal" data-bs-target="#importCategory">
                                Importar <i class="fa-solid fa-folder-open" style="color: #0a0a0a; width=24; height=24"; ></i>
                            </button>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>Categoria</th>
										<th>Sub Categoria</th>
										{{-- <th>Descripción</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subCategories as $subCategory)
                                        <tr>
                                            <td>{{ $subCategory->categoryProduct->name }}</td>
											<td>{{ $subCategory->name }}</td>
                                            {{-- <td>
                                                <form action="{{ route('categorySub.destroy',$subCategory->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('categorySub.show',$subCategory->id) }}"><i class="fa fa-fw fa-eye"></i></a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('categorySub.edit',$subCategory->id) }}"><i class="fa fa-fw fa-edit"></i></a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i></button>
                                                </form>
                                            </td> --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {{-- {!! $subCategories->links() !!} --}}
            </div>
        </div>
    </div>
{{-- @endsection --}}
