import { Chart, registerables } from 'chart.js';

Chart.register(...registerables);
window.Chart = Chart;

document.addEventListener('alpine:init', () => {
    window.Alpine.data('clipboard', (textToCopy = '') => ({
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
});
