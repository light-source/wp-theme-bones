import {controller, target} from '@github/catalyst';
import dependency from "../Dependency/dependency";

declare global {
    interface Window {
        wpThemeBones: any;
    }
}

dependency.set('catalyst', {controller, target});
