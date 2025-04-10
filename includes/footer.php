
        </main>
    </div> <!-- fecha .wrapper -->

    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Marca o link ativo no menu
        document.addEventListener('DOMContentLoaded', function() {
            const currentPage = location.pathname.split('/').pop();
            document.querySelectorAll('.nav-link').forEach(link => {
                if (link.getAttribute('href') === currentPage) {
                    link.classList.add('active');
                }
            });
            
            // Ajuste para mobile
            if (window.innerWidth <= 768) {
                document.querySelector('.sidebar').style.height = 'auto';
            }
        });
    </script>

</body>
</html>