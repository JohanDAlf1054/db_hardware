@include('product.barra', ['modo'=>'Categoria'] )
<link rel="stylesheet" href="{{asset('css/categorias/all.css')}}">
<div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="input-group mb-3">
                                <button type="button" class="btn btn-light">
                                    <a class="back" href="{{route('products.index')}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l14 0" /><path d="M5 12l6 6" /><path d="M5 12l6 -6" /></svg>
                                    </a>
                                </button>
                                <a href="{{ route('category.create') }}"><button type="button" class="btn btn-primary mx-2 rounded btn-lg">Crear Categoria</a></button>
                                <input type="text" wire:model.live='search'  class="form-control" placeholder="Buscar...">
                            </div>
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
										<th>Nombre</th>
                                        <th>Descripcion</th>
                                        <th>Sub Categoria</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categoryProducts as $category)
                                        <tr> 
                                            <td>{{ $category->id}}</td>
											<td>{{ $category->name }}</td>
                                            <td>{{ $category->description }}</td>
                                            <td>{{ $category->subCategory->name }}</td>
                                            <td>
                                                <form action="{{ route('category.destroy',$category->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-success" href="{{ route('category.edit',$category->id) }}"><i class="fa fa-fw fa-edit"></i></a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i></button>
                                                </form>
                                            </td>>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $categoryProducts -> links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- @include('sweetalert::alert') --}}
