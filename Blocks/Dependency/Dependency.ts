export default {
    exists: function (value: any, name: string): void {
        if (value) {
            return;
        }
        throw new Error("Dependency is missing : " + name);
    },
};