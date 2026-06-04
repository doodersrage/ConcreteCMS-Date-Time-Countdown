class Counter {
    constructor(date, counterID) {
        this.diffDays = 0;
        this.remHours = 0;
        this.remMinutes = 0;
        this.remSeconds = 0;
        this.date = date;
        this.currentDate = new Date();
        this.counterID = counterID;
        this.timer = null;

        this.currentDate = new Date();

        if (this.date <= this.currentDate) {
            $(this.counterID).html('Event has passed. Please come back for future updates.');
            return;
        }

        this.clearTimer();
        this.updateValues();
        this.render();
        this.timer = setInterval(() => this.tick(), 1000);
    }

    clearTimer() {
        if (this.timer) {
            clearInterval(this.timer);
            this.timer = null;
        }
    }

    updateValues() {
        this.currentDate = new Date();
        const totalSeconds = Math.max(0, Math.floor((this.date - this.currentDate) / 1000));

        this.diffDays = Math.floor(totalSeconds / 86400);
        let remainder = totalSeconds % 86400;
        this.remHours = Math.floor(remainder / 3600);
        remainder %= 3600;
        this.remMinutes = Math.floor(remainder / 60);
        this.remSeconds = remainder % 60;
    }

    render() {
        const $container = $(this.counterID);
        $container.find('.days-cnt').html(this.diffDays);
        $container.find('.hours-cnt').html(this.remHours);
        $container.find('.minutes-cnt').html(this.remMinutes);
        $container.find('.seconds-cnt').html(this.remSeconds);
    }

    tick() {
        this.updateValues();

        if (this.date <= this.currentDate) {
            this.clearTimer();
            $(this.counterID).html('Event has passed. Please come back for future updates.');
            return;
        }

        this.render();
    }
}