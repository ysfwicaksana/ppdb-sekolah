var confirmDelete = (id) => {
    Swal.fire({
      title: 'Apakah kamu yakin?',
      html: "<p class='msg'>Ingin menghapus data kandidat ini!</p>",
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if(result.isConfirmed) {
        window.location.href = 'delete.php?id=' + id;
        Swal.fire({
            icon: 'success',
            title: 'Berhasil', 
            html: '<p class="."p-popup".">Data siswa berhasil dihapus!</p>',
            showConfirmButton: false,
            timer: 2000
            })
      } else {
        Swal.fire('Batal', 'Tidak jadi menghapus data', 'info');
      }
    })
  }