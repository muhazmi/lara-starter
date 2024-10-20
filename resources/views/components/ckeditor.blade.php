<textarea name="{{ $name }}" id="{{ $name }}" class="form-control @error($name) is-invalid @enderror" style="display:none;">{{ old($name, $value ?? '') }}</textarea>
<input type="hidden" name="{{ $name }}_hidden" id="{{ $name }}_hidden" value="{{ old($name, $value ?? '') }}">

@error($name)
    <div class="text-danger">{{ $message }}</div>
@enderror

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Ambil nilai awal dari hidden input jika ada
        let editorData = document.getElementById('{{ $name }}_hidden').value;

        CKEDITOR.ClassicEditor.create(document.getElementById("{{ $name }}"), {
            // Konfigurasi CKEditor Anda di sini
            toolbar: {
                items: [
                    'exportPDF', 'exportWord', '|',
                    'findAndReplace', 'selectAll', '|',
                    'heading', '|',
                    'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript',
                    'superscript',
                    'removeFormat', '|',
                    'bulletedList', 'numberedList', 'todoList', '|',
                    'outdent', 'indent', '|',
                    'undo', 'redo',
                    '-',
                    'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                    'alignment', '|',
                    'link', 'uploadImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock',
                    'htmlEmbed',
                    '|',
                    'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                    'textPartLanguage', '|',
                    'sourceEditing'
                ],
                shouldNotGroupWhenFull: true
            }
        }).then(editor => {
            // Set data awal CKEditor dengan old value dari Laravel
            editor.setData(editorData);

            // Sinkronkan data dari editor ke hidden input setiap ada perubahan
            editor.model.document.on('change:data', () => {
                document.getElementById('{{ $name }}_hidden').value = editor.getData();
            });
        });

        // Pastikan hidden input diperbarui sebelum form dikirim
        const form = document.querySelector('form');
        form.addEventListener('submit', function () {
            const editorInstance = CKEDITOR.instances['{{ $name }}'];
            if (editorInstance) {
                document.getElementById('{{ $name }}_hidden').value = editorInstance.getData();
            }
        });
    });
</script>
