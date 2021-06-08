import {controller, target} from '@github/catalyst';

class Catalyst extends HTMLElement {

    connectedCallback() {
        "loading" === document.readyState ?
            document.addEventListener('DOMContentLoaded', this.onConnected.bind(this)) :
            this.onConnected();
    }

    onConnected(): void {

    }

}

declare global {
    interface Window {
        _catalyst: {
            controller: any;
            target: any;
            class: typeof Catalyst,
        },
    }
}

window._catalyst = {controller, target, class: Catalyst};
