let currentIdSekolah = null;

function openModal(id, nama) {
    currentIdSekolah = id;
    document.getElementById('editModal').classList.add('open');
    document.getElementById('editNama').value = nama;
    document.getElementById('editForm').action = `/admin/sekolah/update/${id}`;
}

function closeModal() {
    document.getElementById('editModal').classList.remove('open');
}

window.addEventListener('click', function(e) {
    const modal = document.getElementById('editModal');
    if (e.target === modal) closeModal();
});

document.getElementById('btnHapusSekolah').addEventListener('click', function() {
    if (confirm('Yakin ingin menghapus sekolah/kampus ini?')) {
        const form = document.getElementById('formHapusSekolah');
        form.action = `/admin/sekolah/delete/${currentIdSekolah}`;
        form.submit();
    }
});
