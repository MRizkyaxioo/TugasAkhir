// =========================
// MODAL PEMBIMBING LAPANGAN
// =========================

function openEditModal(id, nama, no_telp, nip_nidn, username)
{
    document.getElementById('editModal').style.display = 'flex';

    document.getElementById('editNama').value = nama;
    document.getElementById('editNoTelp').value = no_telp;
    document.getElementById('editNip').value = nip_nidn;
    document.getElementById('editUsername').value = username;

    document.getElementById('editForm').action =
        `/admin/pembimbing/update/${id}`;
}

function closeModal()
{
    document.getElementById('editModal').style.display = 'none';
}


// =========================
// MODAL PEMBIMBING ASAL
// =========================

function openEditModalAsal(
    id,
    nama,
    no_telp,
    username,
    id_sekolah_kampus
)
{
    document.getElementById('editModalAsal').style.display = 'flex';

    document.getElementById('editNamaAsal').value = nama;
    document.getElementById('editNoTelpAsal').value = no_telp;
    document.getElementById('editUsernameAsal').value = username;
    document.getElementById('editSekolahAsal').value = id_sekolah_kampus;

    document.getElementById('editFormAsal').action =
        `/admin/pembimbing-asal/update/${id}`;
}

function closeModalAsal()
{
    document.getElementById('editModalAsal').style.display = 'none';
}


// =========================
// CLOSE MODAL SAAT KLIK LUAR
// =========================

window.onclick = function(e)
{
    let modal1 = document.getElementById('editModal');
    let modal2 = document.getElementById('editModalAsal');

    if(e.target == modal1){
        closeModal();
    }

    if(e.target == modal2){
        closeModalAsal();
    }
}


// =========================
// TOGGLE PASSWORD
// =========================

function togglePassword(id)
{
    let input = document.getElementById(id);

    if(input.type === 'password'){
        input.type = 'text';
    }else{
        input.type = 'password';
    }
}
