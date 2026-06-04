const counter = {
    vars: {
        diffDays: 0,
        remHours: 0,
        remMinutes: 0,
        remSeconds: 0,
        date: new Date(),
        currentDate: new Date(),
        counterID: '',
        timer: null
    },
    initCounter: function() {
        const { vars } = this;
        vars.currentDate = new Date();

        if (vars.date <= vars.currentDate) {
            $(vars.counterID).html('Event has passed. Please come back for future updates.');
            return;
        }

        this.clearTimer();
        this.updateValues();
        this.render();
        vars.timer = setInterval(this.tick.bind(this), 1000);
    },
    clearTimer: function() {
        if (this.vars.timer) {
            clearInterval(this.vars.timer);
            this.vars.timer = null;
        }
    },
    updateValues: function() {
        const vars = this.vars;
        vars.currentDate = new Date();
        const totalSeconds = Math.max(0, Math.floor((vars.date - vars.currentDate) / 1000));

        vars.diffDays = Math.floor(totalSeconds / 86400);
        let remainder = totalSeconds % 86400;
        vars.remHours = Math.floor(remainder / 3600);
        remainder %= 3600;
        vars.remMinutes = Math.floor(remainder / 60);
        vars.remSeconds = remainder % 60;
    },
    render: function() {
        const $container = $(this.vars.counterID);
        $container.find('.days-cnt').html(this.vars.diffDays);
        $container.find('.hours-cnt').html(this.vars.remHours);
        $container.find('.minutes-cnt').html(this.vars.remMinutes);
        $container.find('.seconds-cnt').html(this.vars.remSeconds);
    },
    tick: function() {
        this.updateValues();

        if (this.vars.date <= this.vars.currentDate) {
            this.clearTimer();
            $(this.vars.counterID).html('Event has passed. Please come back for future updates.');
            return;
        }

        this.render();
    }
};