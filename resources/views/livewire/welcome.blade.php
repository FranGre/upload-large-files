<div x-data="uploader">
    <input type="file" x-ref="file" />
    <button x-on:click="upload">Upload</button>
</div>


<script src=" https://cdn.jsdelivr.net/npm/resumablejs@1.1.0/resumable.min.js "></script>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('uploader', () => ({
            upload(){
                const file = this.$refs.file.files[0]

                var resumable = new Resumable({
                    headers: {
                        'X-CSRF-TOKEN' : "{{ csrf_token() }}"
                    },
                    target: "{{route('upload.large.video')}}",
                    chunkSize: 5 * 1024 * 1024,
                    testChunks: false
                })
                
                resumable.addFile(file)

                resumable.on('fileAdded', function(file, event){
                    resumable.upload()
                })
            }
        }))
    })
</script>