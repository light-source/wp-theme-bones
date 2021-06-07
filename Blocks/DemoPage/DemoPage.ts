import dependency from "../Dependency/dependency";

const catalyst = dependency.get('catalyst');

@catalyst.controller
class DemoPage extends HTMLElement {

    @catalyst.target message: HTMLElement;

    connectedCallback(): void {
        this.message.innerText = "(dynamic js string - block's code has an access to an external dependency)";
    }

}
