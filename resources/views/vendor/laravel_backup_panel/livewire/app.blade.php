<div class="container-fluid px-4 py-1">
    <div class="d-flex align-items-end pt-4">
        <h3 class="mb-0">
            {{ Breadcrumbs::render('backup') }}
        </h3>
        {{-- id="create-backup"  --}}
        <a id="create-backups" class="btn btn-dark btn-sm ml-auto px-3" href="{{ route('backup-create') }}" style="text-decoration: none">
            Crear Copia de Seguridad
        </a>
        <div class="dropdown ml-3">
            <button class="btn btn-warning btn-sm dropdown-toggle px-3" type="button" 
                data-bs-toggle="dropdown"  aria-haspopup="true" aria-expanded="false">
                <svg xmlns="http://www.w3.org/2000/svg" width="0.7875rem" height="0.7875rem" viewBox="0 0 24 24"fill="currentColor">
                    <path class="heroicon-ui" d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z"/>
                </svg>
            </button>
            <ul class="dropdown-menu dropdown-menu-right">
                <li>
                    <a class="dropdown-item" href="{{route('restore-backup')}}">
                        Restaurar Ultima Copia de Seguridad
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('backup-system') }}" id="create-backup-only-files">
                        Crear Copia de Seguridad de todo el Sistema
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header d-flex align-items-end">
                    <button data-bs-toggle="tooltip" title="Recargar" class="btn btn-primary btn-sm btn-refresh ml-auto"
                            wire:loading.class="loading"
                            wire:loading.attr="disabled"
                            wire:click="updateBackupStatuses"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" width="0.7875rem" height="0.7875rem" viewBox="0 0 24 24"
                             fill="currentColor">
                            <path class="heroicon-ui" d="M6 18.7V21a1 1 0 0 1-2 0v-5a1 1 0 0 1 1-1h5a1 1 0 1 1 0 2H7.1A7 7 0 0 0 19 12a1 1 0 1 1 2 0 9 9 0 0 1-15 6.7zM18 5.3V3a1 1 0 0 1 2 0v5a1 1 0 0 1-1 1h-5a1 1 0 0 1 0-2h2.9A7 7 0 0 0 5 12a1 1 0 1 1-2 0 9 9 0 0 1 15-6.7z"/>
                        </svg>
                    </button>
                </div>
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th scope="col" style="font-size: 14px">Unidad</th>
                            <th scope="col" style="font-size: 14px">Estado</th>
                            <th scope="col" style="font-size: 14px">Cantidad de copias</th>
                            <th scope="col" style="font-size: 14px">Copia reciente</th>
                            <th scope="col" style="font-size: 14px">Almacenamiento en uso</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($backupStatuses as $backupStatus)
                        <tr>
                            <td style="font-size: 16px">{{ $backupStatus['disk'] }}</td>
                            <td style="font-size: 16px">
                                @if($backupStatus['healthy'])
                                    <svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" height="24px">
                                        <path d="M2.93 17.07A10 10 0 1 0 17.07 2.93 10 10 0 0 0 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM4 10l2-2 3 3 5-5 2 2-7 7-5-5z" fill="var(--success)" fill-rule="evenodd"/>
                                    </svg>
                                @else
                                    <svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" height="24px">
                                        <path d="M11.41 10l2.83-2.83-1.41-1.41L10 8.59 7.17 5.76 5.76 7.17 8.59 10l-2.83 2.83 1.41 1.41L10 11.41l2.83 2.83 1.41-1.41L11.41 10zm-8.48 7.07A10 10 0 1 0 17.07 2.93 10 10 0 0 0 2.93 17.07zm1.41-1.41A8 8 0 1 0 15.66 4.34 8 8 0 0 0 4.34 15.66z" fill="var(--danger)" fill-rule="evenodd"/>
                                    </svg>
                                @endif
                            </td>
                            <td style="font-size: 16px">{{ $backupStatus['amount'] }}</td>
                            <td style="font-size: 16px">{{ $backupStatus['newest'] }}</td>
                            <td style="font-size: 16px">{{ $backupStatus['usedStorage'] }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="card shadow-sm">
                <div class="card-header d-flex align-items-end">
                    @if(count($disks))
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            @foreach($disks as $disk)
                                <label class="btn btn-outline-secondary {{ $activeDisk === $disk ? 'active' : '' }}"
                                       wire:click="getFiles('{{ $disk }}')"
                                >
                                    <input type="radio" name="options" {{ $activeDisk === $disk ? 'checked' : '' }}>
                                    {{ $disk }}
                                </label>
                            @endforeach
                        </div>
                    @endif

                    <button data-bs-toggle="tooltip" title="Recargar" class="btn btn-primary btn-sm btn-refresh ml-auto"
                                wire:loading.class="loading"
                                wire:loading.attr="disabled"
                                wire:click="getFiles"
                                {{ $activeDisk ? '' : 'disabled' }}
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" width="0.7875rem" height="0.7875rem" viewBox="0 0 24 24" fill="currentColor">
                            <path class="heroicon-ui" d="M6 18.7V21a1 1 0 0 1-2 0v-5a1 1 0 0 1 1-1h5a1 1 0 1 1 0 2H7.1A7 7 0 0 0 19 12a1 1 0 1 1 2 0 9 9 0 0 1-15 6.7zM18 5.3V3a1 1 0 0 1 2 0v5a1 1 0 0 1-1 1h-5a1 1 0 0 1 0-2h2.9A7 7 0 0 0 5 12a1 1 0 1 1-2 0 9 9 0 0 1 15-6.7z"/>
                        </svg>
                    </button>
                </div>

                <table class="table table-hover mb-0">
                    <thead>
                    <tr>
                        <th scope="col" style="font-size: 14px">Nombre del archivo</th>
                        <th scope="col" style="font-size: 14px">Fecha de creación</th>
                        <th scope="col" style="font-size: 14px">Almacenamiento</th>
                        <th scope="col" style="font-size: 14px"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($files as $file)
                        <tr>
                            <td style="font-size: 16px">{{ $file['path'] }}</td>
                            <td style="font-size: 16px">{{ $file['date'] }}</td>
                            <td style="font-size: 16px">{{ $file['size'] }}</td>
                            <td class="text-right pr-3" style="font-size: 16px">
                                <button class="btn btn-outline-secondary btn-sm" data-bs-toggle="tooltip" title="Descargar" target="_blank" wire:click.prevent="downloadFile('{{ $file['path'] }}')">
                                    <i class="fa-solid fa-download"></i>
                                </button>
                                <button class="btn btn-outline-danger btn-sm" data-bs-toggle="tooltip" title="Eliminar" target="_blank" wire:click.prevent="showDeleteModal({{ $loop->index }})">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach

                    @if(!count($files))
                        <tr>
                            <td class="text-center" colspan="4" style="font-size: 16px">
                                {{ 'No hay Copias de Seguridad realizadas.' }}
                            </td>
                        </tr>
                    @endif
                    </tbody>
                </table>

                <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
                     aria-labelledby="exampleModalCenterTitle"
                     aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <h5 class="modal-title mb-3">Eliminar Copia de Seguridad</h5>
                                @if($deletingFile)
                                <span class="text-muted">
                                    Esta seguro de eliminar la copia de seguridad del dia {{ $deletingFile['date'] }} ?
                                </span>
                                @endif
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary cancel-button" data-bs-dismiss="modal">
                                    Cerrar
                                </button>
                                <button type="button" class="btn btn-danger delete-button" wire:click="deleteFile">Eliminar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Inicializar tooltips en la carga inicial
            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
            const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
    
            // Listener para actualizaciones de Livewire
            Livewire.hook('message.processed', (message, component) => {
                const updatedTooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
                const updatedTooltipList = [...updatedTooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
            });
        });
    </script>
    <script>
        document.addEventListener('livewire:load', function () {
            @this.updateBackupStatuses()

            @this.on('backupStatusesUpdated', function () {
                @this.getFiles()
            })

            @this.on('showErrorToast', function (message) {
                Toastify({
                    text: message,
                    duration: 10000,
                    gravity: 'bottom',
                    position: 'right',
                    backgroundColor: 'red',
                    className: 'toastify-custom',
                }).showToast()
            })

            const backupFun = function () {
                Toastify({
                    text: 'Creando Copia de Seguridad' ,
                    duration: 5000,
                    gravity: 'bottom',
                    position: 'right',
                    backgroundColor: '#1fb16e',
                    className: 'toastify-custom',
                }).showToast()

                @this.createBackup(option)
            }

            $('#create-backups').on('click', function () {
                backupFun()
            })
            $('#create-backup-only-db').on('click', function () {
                backupFun('only-db')
            })
            $('#create-backup-only-files').on('click', function () {
                backupFun('only-files')
            })

            const deleteModal = $('#deleteModal')
            @this.on('showDeleteModal', function () {
                deleteModal.modal('show')
            })
            @this.on('hideDeleteModal', function () {
                deleteModal.modal('hide')
            })

            deleteModal.on('hidden.bs.modal', function () {
                @this.deletingFile = null
            })
        })
    </script>
</div>
