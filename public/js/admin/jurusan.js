let currentIdJurusan = null;

    function openModal(id, jurusan) {
        currentIdJurusan = id;
        document.getElementById('editModal').classList.add('open');
        document.getElementById('editJurusan').value = jurusan;
        document.getElementById('editForm').action = `/admin/jurusan/update/${id}`;
    }

    function closeModal() {
    document.getElementById('editModal').classList.remove('open');
}

window.addEventListener('click', function(e) {
    const modal = document.getElementById('editModal');
    if (e.target === modal) closeModal();
});

    document.getElementById('btnHapusJurusan').addEventListener('click', function() {
        if (confirm('Yakin ingin menghapus jurusan ini?')) {
            const form = document.getElementById('formHapusJurusan');
            form.action = `/admin/jurusan/delete/${currentIdJurusan}`;
            form.submit();
        }
    });
