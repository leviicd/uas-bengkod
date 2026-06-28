  </div><!-- /.content-wrapper -->

  <!-- FOOTER -->
  <footer class="main-footer">
    Copyright &copy; 2026 — All rights reserved by <a href="#">Poliklinik</a>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark"></aside>
</div><!-- ./wrapper -->

<!-- Scripts -->
<script src="{{ asset('AdminLTE-3.2.0/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('AdminLTE-3.2.0/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script>$.widget.bridge('uibutton', $.ui.button)</script>
<script src="{{ asset('AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('AdminLTE-3.2.0/plugins/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('AdminLTE-3.2.0/plugins/sparklines/sparkline.js') }}"></script>
<script src="{{ asset('AdminLTE-3.2.0/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('AdminLTE-3.2.0/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<script src="{{ asset('AdminLTE-3.2.0/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<script src="{{ asset('AdminLTE-3.2.0/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('AdminLTE-3.2.0/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('AdminLTE-3.2.0/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<script src="{{ asset('AdminLTE-3.2.0/plugins/summernote/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('AdminLTE-3.2.0/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<script src="{{ asset('AdminLTE-3.2.0/dist/js/adminlte.js') }}"></script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  $(document).ready(function() {
    // Cari semua tombol yang memiliki onclick confirm bawaan browser pada form
    $('form button[onclick*="confirm"], form input[type="submit"][onclick*="confirm"]').each(function() {
      const btn = $(this);
      const onclickStr = btn.attr('onclick') || '';
      // Ekstrak pesan dari confirm('...')
      const match = onclickStr.match(/confirm\(['"](.*?)['"]\)/);
      const message = (match && match[1]) ? match[1] : 'Apakah Anda yakin ingin menghapus data ini?';
      
      // Hapus inline onclick bawaan browser agar tidak memicu notifikasi native saat diklik
      btn.removeAttr('onclick');
      
      // Pasangkan click event handler custom dengan SweetAlert2
      btn.on('click', function(e) {
        e.preventDefault();
        const form = btn.closest('form');

        Swal.fire({
          title: 'Konfirmasi Hapus',
          text: message,
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#ef4444',
          cancelButtonColor: '#64748b',
          confirmButtonText: 'Ya, Hapus!',
          cancelButtonText: 'Batal',
          customClass: {
            popup: 'swal2-premium-popup'
          }
        }).then((result) => {
          if (result.isConfirmed) {
            form.submit();
          }
        });
      });
    });
  });
</script>
</body>
</html>