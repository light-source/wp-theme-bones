import {controller, target} from '@github/catalyst';

declare global {
    interface Window {
        wpThemeBones: any;
    }
}

window.wpThemeBones = window.wpThemeBones || {};
window.wpThemeBones.catalyst = {controller, target};
