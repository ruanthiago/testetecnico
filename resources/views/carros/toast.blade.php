@php
    $toastType = "";
    $toastMsg  = "";

    if(Session::has('flash_success') || Session::has('flash_error')) {
        // Bucando o tipo
        $toastType = Session::has('flash_success') ? 'success' : 'danger';

        // Bucando a menssagem
        $toastMsg = Session::has('flash_success') ? session('flash_success') : session('flash_error');
    }
@endphp

<!-- Toast -->
<div class="position-fixed bottom-0 start-0 p-3" style="z-index: 11">
    <div id="liveToast" class="toast align-items-center text-white bg-{{ $toastType }} border-0" role="alert" aria-atomic="true">
        <div class="toast-header">
            <strong class="me-auto">Menssagem</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body" id="toast-msg">
            {{ $toastMsg }}
        </div>
    </div>
</div>

{{-- Importando o js --}}
@include('carros.toast-js')
