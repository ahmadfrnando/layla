function submitFormAjax(formSelector, actionUrl, successMessage, redirectUrl) {
    $(formSelector).on('submit', function(e) {
        e.preventDefault();
        
        let form = $(this);
        $.ajax({
            url: actionUrl,
            method: 'POST',
            data: form.serialize(),
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            },
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: successMessage || `${response.message}`,
                    confirmButtonText: 'Oke',
                    confirmButtonColor: '#5e72e4'
                }).then((result) => {
                    if (result.isConfirmed && redirectUrl) {
                        window.location.href = redirectUrl;
                    }
                });
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    let res = xhr.responseJSON;
                    let errorMessages = Object.values(res.errors).flat().join('\n');
                    Swal.fire('Validasi Gagal', errorMessages, 'error');
                } else {
                    Swal.fire('Gagal', xhr.responseJSON?.message || 'Terjadi kesalahan.', 'error');
                }
            }
        })
    });
}
