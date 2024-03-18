{{-- @extends('layouts.app')

@section('template_title')
    Sub Category
@endsection

@section('content') --}}
@include('include.barra', ['modo'=>'Sub Categorias'])
    <div class="container-fluid">
        <div class="row">
            <div class="col-10-sm">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center;">
                            <button type="button" class="btn btn-light">
                            <a href="{{route('category.index')}}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l14 0" /><path d="M5 12l6 6" /><path d="M5 12l6 -6" /></svg>
                            </a>
                        </button>
                            <a href="{{ route('categorySub.create') }}" class="btn btn-primary " >
                                  {{ __('Crear Sub Categoria') }}
                            </a>
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
                                        
										<th>Name</th>
										<th>Description</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subCategories as $subCategory)
                                        <tr>
                                            
											<td>{{ $subCategory->name }}</td>
											<td>{{ $subCategory->description }}</td>

                                            <td>
                                                <form action="{{ route('categorySub.destroy',$subCategory->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('categorySub.show',$subCategory->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('categorySub.edit',$subCategory->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                </form>
                                            </td>
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
