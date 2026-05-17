<form action="{{ route('admin.jurusan.store') }}" method="POST">
    @csrf

    <input type="text" name="jurusan" placeholder="Input Jurusan">

    <button type="submit">
        Tambah
    </button>
</form>

<hr>

@foreach($data as $d)

<div style="margin-bottom:15px;">
    <strong>{{ $d->jurusan }}</strong>

    <button onclick="openModal({{ $d->id_jurusan }})">
        Edit
    </button>
</div>

<!-- MODAL -->
<div id="modal{{ $d->id_jurusan }}"
     style="
        display:none;
        position:fixed;
        top:0;
        left:0;
        width:100%;
        height:100%;
        background:rgba(0,0,0,0.5);
     ">

    <div style="
        background:white;
        width:400px;
        padding:20px;
        margin:100px auto;
        border-radius:10px;
    ">

        <h3>Edit Jurusan</h3>

        <form action="{{ route('admin.jurusan.update', $d->id_jurusan) }}"
              method="POST">

            @csrf
            @method('PUT')

            <input type="text"
                   name="jurusan"
                   value="{{ $d->jurusan }}"
                   style="width:100%; padding:8px;">

            <br><br>

            <button type="submit">
                Update
            </button>

            <button type="button"
                    onclick="closeModal({{ $d->id_jurusan }})">
                Batal
            </button>

        </form>
    </div>
</div>

@endforeach

<a href="{{ route('admin.dashboard') }}" class="nav-item">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/>
                    <rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/>
                </svg>
                Dashboard
            </a>

<script>
function openModal(id) {
    document.getElementById('modal' + id).style.display = 'block';
}

function closeModal(id) {
    document.getElementById('modal' + id).style.display = 'none';
}
</script>
