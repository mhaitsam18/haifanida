import './bootstrap';
import './cinematic-hero';
import './home-experience';

import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';
import focus from '@alpinejs/focus';

Alpine.plugin(collapse);
Alpine.plugin(focus);

/**
 * Reusable modal-form controller for admin CRUD create/edit dialogs.
 * Submits via fetch() with Accept: application/json so Laravel's default
 * ValidationException handling returns 422 JSON instead of a redirect,
 * letting the modal stay open and show field errors without a page reload.
 */
Alpine.data('modalForm', () => ({
    open: false,
    submitting: false,
    errors: {},
    previewUrl: null,

    show() {
        this.errors = {};
        this.open = true;
    },

    hide() {
        this.open = false;
    },

    preview(event) {
        const file = event.target.files[0];
        if (file) {
            this.previewUrl = URL.createObjectURL(file);
        }
    },

    /**
     * Cascading provinsi -> kabupaten dropdown, reused across every modal
     * that has a provinsi/kabupaten pair. Pass the kabupaten <select> via
     * $refs, e.g. @change="loadKabupaten($event, $refs.kabupatenSelect)".
     */
    async loadKabupaten(event, selectEl) {
        if (!selectEl) return;

        const response = await fetch('/get-kabupaten', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                Accept: 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
            },
            body: JSON.stringify({ provinsi_id: event.target.value }),
        });
        const data = await response.json();

        selectEl.innerHTML = '<option value="" selected disabled>Pilih Kabupaten</option>';
        data.forEach((kabupaten) => {
            const option = document.createElement('option');
            option.value = kabupaten.id;
            option.textContent = kabupaten.kabupaten;
            selectEl.appendChild(option);
        });
    },

    async submit(event) {
        event.preventDefault();
        this.submitting = true;
        this.errors = {};

        const form = event.target;

        try {
            const response = await fetch(form.action, {
                method: 'POST',
                body: new FormData(form),
                headers: {
                    Accept: 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                },
            });

            if (response.status === 422) {
                const data = await response.json();
                this.errors = data.errors || {};
                this.submitting = false;
                return;
            }

            if (!response.ok) {
                this.submitting = false;
                alert('Terjadi kesalahan. Silakan coba lagi.');
                return;
            }

            window.location.reload();
        } catch (error) {
            this.submitting = false;
            alert('Terjadi kesalahan koneksi. Silakan coba lagi.');
        }
    },
}));

window.Alpine = Alpine;
Alpine.start();
