import {controller, target} from '@github/catalyst';

declare global {
    interface Window {
        _catalyst: {
            controller: any;
            target: any;
        },
    }
}

window._catalyst = {controller, target};
