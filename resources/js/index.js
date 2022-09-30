import alpinejs from 'alpinejs'
import { Editor } from '@tiptap/core'
import StarterKit from '@tiptap/starter-kit'
import Underline from '@tiptap/extension-underline'
import Link from '@tiptap/extension-link'
import 'livewire-sortable'

window.alpinejs = alpinejs
window.Editor = Editor
window.StarterKit = StarterKit
window.Underline = Underline
window.Link = Link

// Triggered from Livewire when selecting
window.addEventListener('load-cropper', (e) => {
    window.cropper = new Cropper(document.getElementById('cropper'), {
        ...e.detail.options,
        viewMode: 1,
        dragMode: 'move',
        ready () {
            this.cropper.setData(e.detail.initial)
        }
    })
})
