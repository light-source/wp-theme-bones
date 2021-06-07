window.wpThemeBones = window.wpThemeBones || {};

export default {
    get: function (name: string): any {
        if (!window.wpThemeBones.hasOwnProperty(name)) {
            throw new Error("Required dependency is missing : " + name);
        }
        return window.wpThemeBones[name];
    },
    set: function (name: string, value: object): void {
        window.wpThemeBones[name] = value;
    }
};