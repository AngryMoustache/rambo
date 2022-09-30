<div class="crud-form-field" wire:ignore>
    <div class="crud-form-field-label">
        <x-rambo::crud.fields.label :field="$field" />
    </div>

    <div class="crud-form-field-input w-60" style="display: block;">
        <div
            x-data="setupEditor{{ $field->getName() }}({{ json_encode(nl2br($field->getValue())) }})"
            x-init="() => init($refs.element)"
        >
            <template x-if="editor">
                <div class="wysiwyg-editor">
                    @for ($i = 1; $i <= 6; $i++)
                        <button
                            @click="editor.chain().toggleHeading({ level: {{ $i }} }).focus().run()"
                            :class="{ 'is-active': editor.isActive('heading', { level: {{ $i }} }) }"
                        >
                            H{{ $i }}
                        </button>
                    @endfor
                    <button
                        @click="editor.chain().toggleBold().focus().run()"
                        :class="{ 'is-active': editor.isActive('bold') }"
                    >
                        <i class="fas fa-bold"></i>
                    </button>
                    <button
                        @click="editor.chain().toggleItalic().focus().run()"
                        :class="{ 'is-active': editor.isActive('italic') }"
                    >
                        <i class="fas fa-italic"></i>
                    </button>
                    <button
                        @click="editor.chain().focus().toggleStrike().run()"
                        :class="{ 'is-active': editor.isActive('strike') }"
                    >
                        <i class="fas fa-strikethrough"></i>
                    </button>
                    <button
                        @click="editor.chain().focus().toggleUnderline().run()"
                        :class="{ 'is-active': editor.isActive('underline') }"
                    >
                        <i class="fas fa-underline"></i>
                    </button>

                    <button
                        @click="setLink"
                        :class="{ 'is-active': editor.isActive('link') }"
                    >
                        <i class="fas fa-link"></i>
                    </button>
                    <button
                        @click="editor.chain().focus().unsetLink().run()"
                        v-if="editor.isActive('link')"
                    >
                        <i class="fas fa-unlink"></i>
                    </button>
                </div>
            </template>

            <div class="wysiwyg-preview" x-ref="element"></div>
        </div>

        <x-rambo::crud.fields.error :field="$field" />
    </div>

    <script>
        window.setupEditor{{ $field->getName() }} = function(content) {
            return {
                editor: null,
                livewire: window.Livewire,
                content: content,
                updatedAt: Date.now(), // force Alpine to rerender on selection change
                init (element) {
                    this.editor = new window.Editor({
                        element: element,
                        extensions: [
                            window.StarterKit,
                            window.Underline,
                            window.Link,
                        ],
                        content: this.content,
                        onUpdate: ({ editor }) => {
                            this.livewire.emit(
                                'changed-value',
                                editor.getHTML(),
                                @js($field->toLivewire())
                            )
                        },
                        onSelectionUpdate: () => {
                            this.updatedAt = Date.now()
                        },
                    })
                },
                setLink () {
                    const url = window.prompt('URL')
                    this.editor.chain().focus().setLink({ href: url }).run()
                },
            }
        }
    </script>
</div>
