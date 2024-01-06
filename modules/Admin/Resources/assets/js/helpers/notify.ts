import { Notify } from "quasar";

type NotifyPosition = "top-left"|"top-right"|"bottom-left"|"bottom-right"|"top"|"bottom"|"left"|"right"|"center";
type NotifyType = 'positive'|'negative'|'warning'|'info'|'ongoing';

interface NotifyParams {
    message: string,
    position: NotifyPosition,
    type: NotifyType,
    caption: string
}

class notify {
    error(
        message: string,
        position: NotifyPosition = 'bottom-right'
    ): void {
        this.display({
            message, position,
            type: 'negative',
            caption: 'Error!'
        });
    }

    success(
        message: string,
        position: NotifyPosition = 'bottom-right'
    ): void {
        this.display({
            message, position,
            type: 'positive',
            caption: 'Success!'
        });
    }

    warning(
        message: string,
        position: NotifyPosition = 'bottom-right'
    ): void {
        this.display({
            message, position,
            type: 'warning',
            caption: 'Warning!'
        });
    }

    private display(params: NotifyParams) {
        Notify.create(params);
    }
}

export default new notify();
