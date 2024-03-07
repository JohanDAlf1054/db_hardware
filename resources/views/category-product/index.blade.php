@include('product.barra', ['modo'=>'Categoria'] )
<div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="input-group mb-3">
                                <a href="{{ route('category.create') }}"><button type="button" class="btn btn-primary mx-2 rounded btn-lg">Crear Marca</a></button>
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
