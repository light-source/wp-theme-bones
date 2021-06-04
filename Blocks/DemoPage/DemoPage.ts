(function () {

    window.wpThemeBones = window.wpThemeBones || {};
    let catalyst = window.wpThemeBones.catalyst || null;

    if (!catalyst) {
        throw new Error("Required dependency is missing");
    }

    @catalyst.controller
    class DemoPage extends HTMLElement {

        @catalyst.target message: HTMLElement;

        connectedCallback(): void {
            this.message.innerText = "(dynamic js string - block's code has an access to an external dependency)";
        }

    }

}());
