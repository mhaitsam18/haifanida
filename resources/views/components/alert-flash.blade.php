@php
    $flashSuccess = session('success');
    $flashError = $errors->any() ? 'Terjadi kesalahan! Periksa kembali data yang Anda masukkan.' : session('error');
    $flashWarning = session('warning');
@endphp

<div
    x-data="{
        toasts: [],
        push(type, message) {
            if (!message) return;
            const id = Date.now() + Math.random();
            this.toasts.push({ id, type, message });
            setTimeout(() => this.dismiss(id), 5000);
        },
        dismiss(id) {
            this.toasts = this.toasts.filter(t => t.id !== id);
        },
    }"
    x-init="
        push('success', @js($flashSuccess));
        push('danger', @js($flashError));
        push('warning', @js($flashWarning));
    "
    class="fixed top-4 right-4 z-50 flex w-full max-w-sm flex-col gap-2"
>
    <template x-for="toast in toasts" :key="toast.id">
        <div
            x-show="true"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            :class="{
                'border-emerald-300 bg-emerald-50 text-emerald-800': toast.type === 'success',
                'border-maroon-300 bg-maroon-50 text-maroon-800': toast.type === 'danger',
                'border-amber-300 bg-amber-50 text-amber-800': toast.type === 'warning',
            }"
            class="flex items-start gap-3 rounded-lg border px-4 py-3 shadow-lg"
        >
            <span x-text="toast.message" class="flex-1 text-sm font-medium"></span>
            <button type="button" @click="dismiss(toast.id)" class="text-current/60 hover:text-current">&times;</button>
        </div>
    </template>
</div>
