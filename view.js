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
        this.timer = setInterval(() => this.tick(), 1000);
    }

    clearTimer() {
        if (this.timer) {
            clearInterval(this.timer);
            this.timer = null;
        }
    }

    showMessage(message) {
        this.clearTimer();
        const paragraph = document.createElement('p');
        paragraph.className = 'counter-message';
        paragraph.textContent = message;
        this.container.replaceChildren(paragraph);
    }

    updateValues() {
        const now = new Date();
        const totalSeconds = Math.max(0, Math.floor((this.date - now) / 1000));

        this.diffDays = Math.floor(totalSeconds / 86400);
        let remainder = totalSeconds % 86400;
        this.remHours = Math.floor(remainder / 3600);
        remainder %= 3600;
        this.remMinutes = Math.floor(remainder / 60);
        this.remSeconds = remainder % 60;
    }

    render() {
        this.container.querySelector('.days-cnt').textContent = this.diffDays;
        this.container.querySelector('.hours-cnt').textContent = this.pad(this.remHours);
        this.container.querySelector('.minutes-cnt').textContent = this.pad(this.remMinutes);
        this.container.querySelector('.seconds-cnt').textContent = this.pad(this.remSeconds);
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

$(function () {
    $('.ccm-block-date-counter[data-target-date]').each(function () {
        const targetDate = this.getAttribute('data-target-date');

        if (targetDate) {
            new Counter(new Date(targetDate), this);
        }
    });
});
