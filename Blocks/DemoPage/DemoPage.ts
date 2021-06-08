import dependency from "../Dependency/Dependency";

const catalyst = window._catalyst;
dependency.exists(catalyst, "catalyst");

@catalyst.controller
class DemoPageElement extends HTMLElement {

    @catalyst.target message: HTMLElement;

    connectedCallback(): void {
        this.message.innerText = "(dynamic js string - block's code has an access to an external dependency)";
    }

}
