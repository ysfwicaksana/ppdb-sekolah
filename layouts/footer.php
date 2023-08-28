    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
      // fungsi untuk hapus file 
      var confirmDelete = (id) => {
        Swal.fire({
          title: 'Apakah kamu yakin?',
          html: '<p>Ingin menghapus file ini!</p>',
          icon: 'question',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya',
          cancelButtonText: 'Tidak'
        }).then((result) => {
          if(result.isConfirmed) {
            window.location.href = 'delete.php?id=' + id;
            Swal.fire({
              icon: 'success',
              title: 'Berhasil', 
              html: '<p>File berhasil dihapus!</p>',
              showConfirmButton: false,
              timer: 2000
            })
          } else {
            Swal.fire('Batal', 'Tidak jadi menghapus file', 'info');
          }
        })
      }
      
      // fungsi untuk hapus jurusan
      var confirmDeleteMajor = (id) => {
        Swal.fire({
          title: 'Apakah kamu yakin?',
          html: '<p>Ingin menghapus jurusan ini!</p>',
          icon: 'question',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya',
          cancelButtonText: 'Tidak'
        }).then((result) => {
          if(result.isConfirmed) {
            window.location.href = 'delete-major.php?id=' + id;
            Swal.fire({
              icon: 'success',
              title: 'Berhasil', 
              html: '<p>File berhasil dihapus!</p>',
              showConfirmButton: false,
              timer: 2000
            })
          } else {
            Swal.fire('Batal', 'Tidak jadi menghapus file', 'info');
          }
        })
      }
    </script>
  </body>
</html>