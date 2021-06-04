import {controller, target} from '@github/catalyst';

declare global {
    interface Window {
        wpThemeBones: any;
    }
}

(function () {

    window.wpThemeBones = window.wpThemeBones || {};
    window.wpThemeBones.catalyst = {controller, target};

}());

