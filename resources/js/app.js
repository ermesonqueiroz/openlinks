import Alpine from 'alpinejs';

Alpine.data('clipboard', (textToCopy = '') => ({
    copied: false,
    content: textToCopy,
    copy() {
        if (!this.content) return;
        navigator.clipboard.writeText(this.content).then(() => {
            this.copied = true;
            setTimeout(() => this.copied = false, 2000);
        });
    }
}));

window.Alpine = Alpine;
Alpine.start();
