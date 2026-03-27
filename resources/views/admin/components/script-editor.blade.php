@if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: @json(session('success')),
            timer: 2000,
            showConfirmButton: false
        });
    </script>
@endif

<script>
    const csrf = document.querySelector('meta[name="csrf-token"]');
    const title = document.getElementById('title');
    const slug = document.getElementById('slug');

    title.addEventListener('keyup', function() {

        slug.value = title.value
            .toLowerCase()
            .replace(/[^\w ]+/g, '')
            .replace(/ +/g, '-');

    });

    const image_upload = (blobInfo, progress) => new Promise((resolve, reject) => {
        const xhr = new XMLHttpRequest();
        xhr.withCredentials = false;
        xhr.open('POST', '/admin/article/upload-image');
        xhr.setRequestHeader('X-CSRF-TOKEN', csrf.getAttribute('content'));

        xhr.upload.onprogress = (e) => {
            progress(e.loaded / e.total * 100);
        };

        xhr.onload = () => {
            if (xhr.status === 403) {
                reject({
                    message: 'HTTP Error: ' + xhr.status,
                    remove: true
                });
                return;
            }

            if (xhr.status < 200 || xhr.status >= 300) {
                reject('HTTP Error: ' + xhr.status);
                return;
            }

            const json = JSON.parse(xhr.responseText);

            if (!json || typeof json.location != 'string') {
                reject('Invalid JSON: ' + xhr.responseText);
                return;
            }

            resolve(json.location);
        };

        xhr.onerror = () => {
            reject('Image upload failed due to a XHR Transport error. Code: ' + xhr.status);
        };

        const formData = new FormData();
        formData.append('file', blobInfo.blob(), blobInfo.filename());

        xhr.send(formData);
    });

    tinymce.init({
        selector: '#content',
        height: 500,
        plugins: 'image link lists table code preview',
        toolbar: 'undo redo | bold italic | alignleft aligncenter alignright | bullist numlist | link image | table | code preview',

        license_key: 'gpl', // 🔥 WAJIB
        promotion: false,

        image_title: true,

        automatic_uploads: true,

        images_upload_credentials: true,

        paste_data_images: true,
        images_upload_handler: image_upload,

        invalid_attributes: 'data-section-id,data-start,data-end',

        // 🔥 INI WAJIB
        relative_urls: false,
        remove_script_host: false,
        convert_urls: true,
    });

    document.addEventListener("DOMContentLoaded", function() {
        new TomSelect("#tags", {
            plugins: ['remove_button'],
            placeholder: "Pilih tag...",
            create: true, // 🔥 bisa tambah tag baru langsung
        });
    });
</script>
