document.addEventListener('DOMContentLoaded', function () {

    // ==========================
    // TomSelect Edit Jurusan
    // ==========================
    const editJurusan = document.querySelector('#editJurusan');
    if (editJurusan) {
        new TomSelect("#editJurusan", {
            create: false,
            sortField: { field: "text", direction: "asc" },
            placeholder: "Cari jurusan..."
        });
    }

    // ==========================
    // TomSelect Edit Sekolah
    // ==========================
    const editSekolah = document.querySelector('#editSekolah');
    if (editSekolah) {
        new TomSelect("#editSekolah", {
            create: false,
            sortField: { field: "text", direction: "asc" },
            placeholder: "Cari sekolah/kampus..."
        });
    }

    // ==========================
    // Helper: ambil nilai TERKINI setiap field peserta dari DOM,
    // dipakai untuk melengkapi field yang tidak ada di form yang
    // sedang di-submit (mis. edit-nama tidak punya input awal_magang).
    // ==========================
    function getCurrentFieldValue(key) {
        switch (key) {
            case 'nama':
                return document.getElementById('input-nama')?.dataset.original;
            case 'nisn_nim':
                return document.getElementById('input-nisn')?.dataset.original;
            case 'id_jurusan':
                return editJurusan?.dataset.original;
            case 'id_sekolah_kampus':
                return editSekolah?.dataset.original;
            case 'kelas':
                return document.getElementById('input-kelas')?.dataset.original;
            case 'semester':
                return document.getElementById('input-semester')?.dataset.original;
            case 'awal_magang':
                return document.getElementById('input-awal')?.dataset.original;
            case 'akhir_magang':
                return document.getElementById('input-akhir')?.dataset.original;
            default:
                return undefined;
        }
    }

    // Semua field yang controller expect ada di setiap request update peserta
    const ALL_PESERTA_FIELDS = [
        'nama', 'nisn_nim', 'id_jurusan', 'id_sekolah_kampus',
        'kelas', 'semester', 'awal_magang', 'akhir_magang'
    ];

    // ==========================
    // AJAX submit untuk form edit data (nama, nisn, jurusan, sekolah, dst)
    // ==========================
    const editForms = ['edit-nama', 'edit-nisn', 'edit-jurusan', 'edit-sekolah', 'edit-kelas', 'edit-semester', 'edit-awal', 'edit-akhir'];

    editForms.forEach(formId => {
        const form = document.getElementById(formId);
        if (!form) return;

        form.addEventListener('submit', function (e) {
            e.preventDefault();

            const field = formId.replace('edit-', '');
            const submitBtn = form.querySelector('.btn-save-icon');
            if (submitBtn) submitBtn.disabled = true;

            // bersihkan error lama
            form.querySelectorAll('.edit-error').forEach(el => el.remove());

            const formData = new FormData(form);

            // Lengkapi field yang tidak ada di form ini dengan nilai
            // terkini dari DOM, supaya validasi controller (yang
            // mengharapkan semua field peserta) tidak gagal karena
            // field hilang.
            ALL_PESERTA_FIELDS.forEach(key => {
                if (!formData.has(key)) {
                    const val = getCurrentFieldValue(key);
                    if (val !== undefined && val !== null) {
                        formData.set(key, val);
                    }
                }
            });

            fetch(form.action, {
                method: 'POST', // Laravel method-spoofing lewat _method di FormData tetap berfungsi
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: formData
            })
            .then(async res => {
                const json = await res.json();
                if (!res.ok) throw json;
                return json;
            })
            .then(json => {
                // update tampilan nilai sesuai field
                if (field === 'nama') {
                    document.querySelector('#view-nama .info-value').textContent = json.data.nama;
                } else if (field === 'nisn') {
                    document.querySelector('#view-nisn .info-value').textContent = json.data.nisn_nim;
                } else if (field === 'jurusan') {
                    document.querySelector('#view-jurusan .info-value').textContent = json.data.jurusan;
                } else if (field === 'sekolah') {
                    document.querySelector('#view-sekolah .info-value').textContent = json.data.sekolah_kampus;
                } else if (field === 'kelas') {
                    document.querySelector('#view-kelas .info-value').textContent = json.data.kelas;
                } else if (field === 'semester') {
                    document.querySelector('#view-semester .info-value').textContent = json.data.semester;
                } else if (field === 'awal') {
                    document.querySelector('#view-awal .info-value').textContent = json.data.awal_magang;
                } else if (field === 'akhir') {
                    document.querySelector('#view-akhir .info-value').textContent = json.data.akhir_magang;
                }

                // Perbarui juga data-original di setiap input supaya
                // helper getCurrentFieldValue tetap akurat untuk edit berikutnya
                if (json.data) {
                    const originalMap = {
                        'input-nama': json.data.nama,
                        'input-nisn': json.data.nisn_nim,
                        'input-kelas': json.data.kelas,
                        'input-semester': json.data.semester,
                        'input-awal': json.data.awal_magang,
                        'input-akhir': json.data.akhir_magang
                    };
                    Object.keys(originalMap).forEach(id => {
                        const el = document.getElementById(id);
                        if (el && originalMap[id] !== undefined && originalMap[id] !== null) {
                            el.dataset.original = originalMap[id];
                        }
                    });
                    if (editJurusan && json.data.id_jurusan !== undefined) {
                        editJurusan.dataset.original = json.data.id_jurusan;
                    }
                    if (editSekolah && json.data.id_sekolah_kampus !== undefined) {
                        editSekolah.dataset.original = json.data.id_sekolah_kampus;
                    }
                }

                // tutup form edit, balik ke view mode
                form.classList.remove('is-visible');
                const viewEl = document.getElementById('view-' + field);
                const editBtn = document.querySelector('.btn-edit-icon[data-field="' + field + '"]');
                if (viewEl) viewEl.style.display = 'flex';
                if (editBtn) editBtn.style.display = 'inline-flex';

                Swal.fire({
                    icon: 'success',
                    title: json.message,
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2200,
                    timerProgressBar: true
                });
            })
            .catch(err => {
                // tampilkan pesan error validasi di field terkait
                if (err.errors) {
                    Object.keys(err.errors).forEach(key => {
                        const input = form.querySelector('[name="' + key + '"]');
                        if (input) {
                            const span = document.createElement('span');
                            span.className = 'edit-error';
                            span.textContent = err.errors[key][0];
                            input.insertAdjacentElement('afterend', span);
                        } else {
                            // Fallback: field error tidak ada di form ini
                            // (mis. error di awal_magang saat sedang edit nama)
                            // tampilkan lewat toast supaya tidak "silent"
                            Swal.fire({
                                icon: 'error',
                                title: err.errors[key][0],
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3200
                            });
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: err.message || 'Terjadi kesalahan, coba lagi.',
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2600
                    });
                }
            })
            .finally(() => {
                if (submitBtn) submitBtn.disabled = false;
            });
        });
    });

    // ==========================
    // Toggle Edit Field (Nama, NISN, Jurusan, Sekolah, dst)
    // ==========================
    document.querySelectorAll('.btn-edit-icon').forEach(btn => {
        btn.addEventListener('click', function () {
            const field = this.dataset.field;
            const viewEl = document.getElementById('view-' + field);
            const editEl = document.getElementById('edit-' + field);
            if (viewEl) viewEl.style.display = 'none';
            this.style.display = 'none';
            if (editEl) editEl.classList.add('is-visible');

            if (editEl) {
                const firstField = editEl.querySelector('.edit-input, .edit-select');
                if (firstField && firstField.tagName === 'INPUT') {
                    firstField.focus();
                    firstField.select();
                }
            }
        });
    });

    document.querySelectorAll('.btn-cancel-icon').forEach(btn => {
        btn.addEventListener('click', function () {
            const field = this.dataset.field;
            const form = document.getElementById('edit-' + field);
            const viewEl = document.getElementById('view-' + field);
            const editBtn = document.querySelector('.btn-edit-icon[data-field="' + field + '"]');

            if (form) form.classList.remove('is-visible');
            if (viewEl) viewEl.style.display = 'flex';
            if (editBtn) editBtn.style.display = 'inline-flex';

            const textInput = document.getElementById('input-' + field);
            if (textInput) {
                textInput.value = textInput.dataset.original;
            }

            if (field === 'jurusan' && editJurusan && editJurusan.tomselect) {
                editJurusan.tomselect.setValue(editJurusan.dataset.original || '');
            }
            if (field === 'sekolah' && editSekolah && editSekolah.tomselect) {
                editSekolah.tomselect.setValue(editSekolah.dataset.original || '');
            }
        });
    });

    // ==========================
    // Konfirmasi Akhiri Magang
    // ==========================
    const formSelesai = document.getElementById('formSelesai');
    if (formSelesai) {
        formSelesai.addEventListener('submit', function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'Akhiri sesi magang?',
                text: 'Peserta akan dipindahkan ke riwayat peserta magang.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#166534',
                cancelButtonColor: '#7A6E62',
                confirmButtonText: 'Ya, Selesaikan',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        });
    }

    // ==========================
    // Notifikasi hasil update data (baca window.pesertaFlash)
    // ==========================
    if (window.pesertaFlash) {
        const { success, warning, error } = window.pesertaFlash;

        if (success) {
            Swal.fire({ icon: 'success', title: success, toast: true, position: 'top-end', showConfirmButton: false, timer: 2200, timerProgressBar: true });
        }
        if (warning) {
            Swal.fire({ icon: 'info', title: warning, toast: true, position: 'top-end', showConfirmButton: false, timer: 2600, timerProgressBar: true });
        }
        if (error) {
            Swal.fire({ icon: 'error', title: error, toast: true, position: 'top-end', showConfirmButton: false, timer: 2600, timerProgressBar: true });
        }
    }
});