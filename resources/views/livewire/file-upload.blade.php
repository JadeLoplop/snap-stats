<div>
    <form wire:submit.prevent="save" method="post" enctype="multipart/form-data" >

        <button type="button" class="btn btn-dark" onclick="openFileUpload()">
            <span id="filename"><i class="fa fa-upload" aria-hidden="true"></i>&nbsp;Import Excel</span>
        </button>
        <input type="file" wire:model="file" style="display: none;" id="fileInput" />
        {{-- @error('file') <span class="d-flex invalid-feedback">{{ $message }}</span> @enderror --}}
        @if ($file)
        <div class="flex flex-row gap-3">
            <p>File Uploaded: {{ $file->getClientOriginalName() }}</p>
            <button type="submit" class="btn btn-primary" {{ $isValid ? '' : 'disabled' }}>Upload</button>
        </div>
        @endif

        @foreach ($errors as $item)
            {{ $item }}
        @endforeach


</div>

<script>
    function openFileUpload() {
        document.getElementById('fileInput').click();
    }

</script>
