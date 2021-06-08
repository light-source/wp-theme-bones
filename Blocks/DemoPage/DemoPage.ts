import dependency from "../Dependency/Dependency";

const catalyst = window._catalyst;
dependency.exists(catalyst, "catalyst");

@catalyst.controller
class DemoPageElement extends catalyst.class {

    @catalyst.target message: HTMLElement;

    onConnected() {
        super.onConnected();

        this.message.innerText = "(dynamic js string - block's code has an access to an external dependency)";
    }

}
