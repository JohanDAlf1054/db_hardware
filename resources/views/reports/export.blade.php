@include('include.barra', ['modo'=>'Informes'])
<div class="container px-4 py-5" id="hanging-icons">
    <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
      <div class="col d-flex align-items-start">
        <div class="icon-square bg-light text-dark flex-shrink-0 me-3">
            {{-- <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-kanban-fill" viewBox="0 0 16 16">
                <path d="M2.5 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h11a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm5 2h1a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1V3a1 1 0 0 1 1-1m-5 1a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1zm9-1h1a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1V3a1 1 0 0 1 1-1"/>
            </svg> --}}
        </div>
        <div>
          <h2>Exportar Informe Productos</h2>
            <p>Paragraph of text beneath the heading to explain the heading. We'll add onto it with another sentence and probably just keep going until we run out of words.</p>
            <a class="btn btn btn-success " href="{{route('export')}}">
              <i class="fa-solid fa-file-excel"></i> Excel
            </a>
            <a class="btn btn btn-danger " href="">
              <i class="fa-solid fa-file-pdf"></i> PDF
            </a>
        </div>
      </div>
      
      <div class="col d-flex align-items-start">
        <div class="icon-square bg-light text-dark flex-shrink-0 me-3">
          {{-- <svg class="bi" width="1em" height="1em"><use xlink:href="#cpu-fill"/></svg> --}}
        </div>
        <div>
          <h2>Exportar Informe Ventas</h2>
            <p>Paragraph of text beneath the heading to explain the heading. We'll add onto it with another sentence and probably just keep going until we run out of words.</p>
            <a href="#" class="btn btn-success">
              <i class="fa-solid fa-file-excel"></i> Excel
            </a>
            <a href="#" class="btn btn-danger">
              <i class="fa-solid fa-file-pdf"></i>PDF
            </a>
        </div>
      </div>

      <div class="col d-flex align-items-start">
        <div class="icon-square bg-light text-dark flex-shrink-0 me-3">
          {{-- <svg class="bi" width="1em" height="1em"><use xlink:href="#tools"/></svg> --}}
        </div>
        <div>
          <h2>Exportar Informe Compras</h2>
            <p>Paragraph of text beneath the heading to explain the heading. We'll add onto it with another sentence and probably just keep going until we run out of words.</p>
            <a href="#" class="btn btn-success">
              <i class="fa-solid fa-file-excel"></i> Excel
            </a>
            <a href="#" class="btn btn-danger">
              <i class="fa-solid fa-file-pdf"></i>PDF
            </a>
        </div>
      </div>
    </div>
</div>
<div class="container px-4 py-5" id="hanging-icons">
  <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
    <div class="col d-flex align-items-start">
      <div class="icon-square bg-light text-dark flex-shrink-0 me-3">
          {{-- <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-kanban-fill" viewBox="0 0 16 16">
              <path d="M2.5 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h11a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm5 2h1a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1V3a1 1 0 0 1 1-1m-5 1a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1zm9-1h1a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1V3a1 1 0 0 1 1-1"/>
          </svg> --}}
      </div>
      <div>
        <h2>Exportar Informe Proveedores</h2>
          <p>Paragraph of text beneath the heading to explain the heading. We'll add onto it with another sentence and probably just keep going until we run out of words.</p>
          <a class="btn btn btn-success " href="#">
            <i class="fa-solid fa-file-excel"></i> Excel
          </a>
          <a class="btn btn btn-danger " href="">
            <i class="fa-solid fa-file-pdf"></i>PDF
          </a>
      </div>
    </div>
    
    <div class="col d-flex align-items-start">
      <div class="icon-square bg-light text-dark flex-shrink-0 me-3">
        {{-- <svg class="bi" width="1em" height="1em"><use xlink:href="#cpu-fill"/></svg> --}}
      </div>
      <div>
        <h2>Exportar Informe Clientes</h2>
          <p>Paragraph of text beneath the heading to explain the heading. We'll add onto it with another sentence and probably just keep going until we run out of words.</p>
          <a href="#" class="btn btn-success">
            <i class="fa-solid fa-file-excel"></i> Excel
          </a>
          <a href="#" class="btn btn-danger">
            <i class="fa-solid fa-file-pdf"></i>PDF 
          </a>
      </div>
    </div>

    <div class="col d-flex align-items-start">
      <div class="icon-square bg-light text-dark flex-shrink-0 me-3">
        {{-- <svg class="bi" width="1em" height="1em"><use xlink:href="#tools"/></svg> --}}
      </div>
      <div>
        <h2>Exportar Informe</h2>
          <p>Paragraph of text beneath the heading to explain the heading. We'll add onto it with another sentence and probably just keep going until we run out of words.</p>
          <a href="#" class="btn btn-success">
            <i class="fa-solid fa-file-excel"></i> Excel
          </a>
          <a href="#" class="btn btn-danger">
            <i class="fa-solid fa-file-pdf"></i>PDF
          </a>
      </div>
    </div>
  </div>
</div>