(function () {
    'use strict';

    class Counter {
        constructor(date, container) {
            this.date = date;
            this.container = container;
            this.expiredMessage = container.getAttribute('data-expired-message')
                || 'Event has passed. Please come back for future updates.';
            this.invalidMessage = container.getAttribute('data-invalid-message') || 'Invalid target date.';
            this.timer = null;

            if (Number.isNaN(this.date.getTime())) {
                this.showMessage(this.invalidMessage);
                return;
            }

            this.updateValues();

            if (this.date <= new Date()) {
                this.showMessage(this.expiredMessage);
                return;
            }

            this.render();
            this.timer = window.setInterval(() => this.tick(), 1000);
        }

        clearTimer() {
            if (this.timer) {
                window.clearInterval(this.timer);
                this.timer = null;
            }
        }

        showMessage(message) {
            this.clearTimer();
            const paragraph = document.createElement('p');
            paragraph.className = 'ccm-block-date-counter__message';
            paragraph.textContent = message;
            this.container.replaceChildren(paragraph);
        }

        updateValues() {
            const totalSeconds = Math.max(0, Math.floor((this.date - new Date()) / 1000));

            this.diffDays = Math.floor(totalSeconds / 86400);
            let remainder = totalSeconds % 86400;
            this.remHours = Math.floor(remainder / 3600);
            remainder %= 3600;
            this.remMinutes = Math.floor(remainder / 60);
            this.remSeconds = remainder % 60;
        }

        render() {
            const days = this.container.querySelector('.days-cnt');
            const hours = this.container.querySelector('.hours-cnt');
            const minutes = this.container.querySelector('.minutes-cnt');
            const seconds = this.container.querySelector('.seconds-cnt');

            if (!days || !hours || !minutes || !seconds) {
                return;
            }

            days.textContent = String(this.diffDays);
            hours.textContent = this.pad(this.remHours);
            minutes.textContent = this.pad(this.remMinutes);
            seconds.textContent = this.pad(this.remSeconds);
        }

        pad(value) {
            return String(value).padStart(2, '0');
        }

        tick() {
            this.updateValues();

            if (this.date <= new Date()) {
                this.showMessage(this.expiredMessage);
                return;
            }

            this.render();
        }
    }

    function initCounters(root) {
        const scope = root || document;
        scope.querySelectorAll('.ccm-block-date-counter[data-target-date]').forEach((container) => {
            if (container.dataset.counterInitialized === '1') {
                return;
            }

            const targetDate = container.getAttribute('data-target-date');
            if (!targetDate) {
                return;
            }

            container.dataset.counterInitialized = '1';
            new Counter(new Date(targetDate), container);
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () => initCounters());
    } else {
        initCounters();
    }

    // Support Concrete edit-mode / AJAX block reloads when available.
    if (typeof Concrete !== 'undefined' && Concrete.event && Concrete.event.bind) {
        Concrete.event.bind('EditModeBlockAddNew', () => initCounters());
        Concrete.event.bind('EditModeUpdateBlockComplete', () => initCounters());
    }
})();
