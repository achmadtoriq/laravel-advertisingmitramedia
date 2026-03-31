<x-layout-dashboard>

    <textarea id="editor" name="content" class="w-full border rounded-lg p-3"></textarea>

    <!-- CDN CKEditor -->
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            ClassicEditor
                .create(document.querySelector('#editor'))
                .catch(error => {
                    console.error(error);
                });
        });
    </script>

</x-layout-dashboard>