<script>
    /* Validando toast */
    let isShowToast = `{{ (!empty($toastType) && !empty($toastMsg)) ? 'true' : 'false' }}` == 'true'

    /* Printando o toast, caso necessario */
    if (isShowToast) setTimeout(() => new bootstrap.Toast(document.getElementById('liveToast')).show(), 500)
</script>
